<?php

namespace App\Http\Controllers\Storefront;

use Auth;
use App\Shop;
use App\Cart;
use App\Order;
use App\Coupon;
use App\Inventory;
use App\Packaging;
use App\ShippingRate;
use App\Helpers\ListHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\DirectCheckoutRequest;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $expressId = Null)
    {
        $carts = Cart::whereNull('customer_id')->where('ip_address', $request->ip());

        if(Auth::guard('customer')->check())
            $carts = $carts->orWhere('customer_id', Auth::guard('customer')->user()->id);

        $carts = $carts->get();

        // Load related models
        $carts->load(['shop' => function($q) {
            $q->with(['config', 'packagings' => function($query){
                $query->active();
            }])->active();
        }, 'inventories.image', 'shippingPackage']);

        $countries = ListHelper::countries(); // Country list for shop_to dropdown

        $platformDefaultPackaging = getPlatformDefaultPackaging(); // Get platform's default packaging

        return view('cart', compact('carts','countries','platformDefaultPackaging','expressId'));
    }

    /**
     * Validate coupon.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request, $slug)
    {
        $item = Inventory::where('slug', $slug)->first();

        $customer_id = Auth::guard('customer')->check() ? Auth::guard('customer')->user()->id : Null;

        if($customer_id){
            $old_cart = Cart::where('shop_id', $item->shop_id)->where(function($query) use ($customer_id){
                $query->where('customer_id', $customer_id)->orWhere(function($q){
                    $q->whereNull('customer_id')->where('ip_address', request()->ip());
                });
            })->first();
        }
        else{
            $old_cart = Cart::where('shop_id', $item->shop_id)->whereNull('customer_id')->where('ip_address', $request->ip())->first();
        }

        // Check if the item is alrealy in the cart
        if($old_cart){
            $item_in_cart = \DB::table('cart_items')->where('cart_id', $old_cart->id)->where('inventory_id', $item->id)->first();
            if($item_in_cart) return response()->json(['cart_id' => $item_in_cart->cart_id], 444);  // Item alrealy in cart
        }

        $qtt = $request->quantity ?? $item->min_order_quantity;
        // $shipping_rate_id = $old_cart ? $old_cart->shipping_rate_id : $request->shippingRateId;
        $unit_price = $item->currnt_sale_price();

        // Instantiate new cart if old cart not found for the shop and customer
        $cart = $old_cart ?? new Cart;
        $cart->shop_id = $item->shop_id;
        $cart->customer_id = $customer_id;
        $cart->ip_address = $request->ip();
        $cart->item_count = $old_cart ? ($old_cart->item_count + 1) : 1;
        $cart->quantity = $old_cart ? ($old_cart->quantity + $qtt) : $qtt;

        if($request->shipTo)
            $cart->ship_to = $request->shipTo;

        //Reset if the old cart exist, bcoz shipping rate will change after adding new item
        $cart->shipping_zone_id = $old_cart ? Null : $request->shippingZoneId;
        $cart->shipping_rate_id = $old_cart ? Null : $request->shippingRateId == 'Null' ? Null : $request->shippingRateId;

        $cart->handling = $old_cart ? $old_cart->handling : getShopConfig($item->shop_id, 'order_handling_cost');
        $cart->total = $old_cart ? ($old_cart->total + ($qtt * $unit_price)) : $unit_price;
        // $cart->packaging_id = $old_cart ? $old_cart->packaging_id : 1;

        // All items need to have shipping_weight to calculate shipping
        // If any one the item missing shipping_weight set null to cart shipping_weight
        if($item->shipping_weight == Null || ($old_cart && $old_cart->shipping_weight == Null))
            $cart->shipping_weight = Null;
        else
            $cart->shipping_weight = $old_cart ? ($old_cart->shipping_weight + $item->shipping_weight) : $item->shipping_weight;

        $cart->save();

        // Makes item_description field
        $attributes = implode(' - ', $item->attributeValues->pluck('value')->toArray());
        // Prepare pivot data
        $cart_item_pivot_data = [];
        $cart_item_pivot_data[$item->id] = [
            'inventory_id' => $item->id,
            'item_description'=> $item->title . ' - ' . $attributes . ' - ' . $item->condition,
            'quantity' => $qtt,
            'unit_price' => $unit_price,
        ];

        // Save cart items into pivot
        if (!empty($cart_item_pivot_data))
            $cart->inventories()->syncWithoutDetaching($cart_item_pivot_data);

        return response()->json($cart->toArray(), 200);
    }

    /**
     * Update the cart and redirected to checkout page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart    $cart
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        if( !crosscheckCartOwnership($request, $cart) )
            return redirect()->route('cart.index')->with('warning', trans('theme.notify.please_login_to_checkout'));

        $cart = crosscheckAndUpdateOldCartInfo($request, $cart);

        return redirect()->route('cart.checkout', $cart);
    }

    /**
     * Checkout the specified cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request, Cart $cart)
    {
        if( !crosscheckCartOwnership($request, $cart) )
            return redirect()->route('cart.index')->with('warning', trans('theme.notify.please_login_to_checkout'));

        $cart = crosscheckAndUpdateOldCartInfo($request, $cart);

        $shop = Shop::where('id', $cart->shop_id)->active()->with(['paymentMethods' => function($q){
            $q->active();
        }, 'config'])->first();

        // Abort if the shop is not exist or inactive
        abort_unless( $shop, 406, trans('theme.notify.seller_has_no_payment_method') );

        $customer = Auth::guard('customer')->check() ? Auth::guard('customer')->user() : Null;
        $countries = ListHelper::countries(); // Country list for shop_to dropdown

        return view('checkout', compact('cart', 'customer', 'shop', 'countries'));
    }

    /**
     * Direct checkout with the item/cart
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  str $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function directCheckout(DirectCheckoutRequest $request, $slug)
    {
        $cart = $this->addToCart($request, $slug);

        if (200 == $cart->status())
            return redirect()->route('cart.index', $cart->getdata()->id);
        else if (444 == $cart->status())
            return redirect()->route('cart.index', $cart->getdata()->cart_id);

        return redirect()->back()->with('warning', trans('theme.notify.failed'));
    }

    /**
     * validate coupon.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request)
    {
        $cart = Cart::findOrFail($request->cart);

        $result = \DB::table('cart_items')->where([
            ['cart_id', $request->cart],
            ['inventory_id', $request->item],
        ])->delete();

        if($result){
            if( ! $cart->inventories()->count() )
                $cart->forceDelete();

            return response('Item removed', 200);
        }

        return response('Item remove failed!', 404);
    }

    /**
     * validate coupon.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function validateCoupon(Request $request)
    {
        // $request->all();
        $coupon = Coupon::active()->where([
            ['code', $request->coupon],
            ['shop_id', $request->shop],
        ])->withCount(['orders','customerOrders'])->first();

        if( ! $coupon ) return response('Coupon not found', 404);

        if( ! $coupon->isLive() || ! $coupon->isValidCustomer() ) return response('Coupon not valid', 403);

        if( ! $coupon->isValidZone($request->zone) ) return response('Coupon not valid for shipping area', 443);

        if( ! $coupon->hasQtt() ) return response('Coupon qtt limit exit', 444);

        return response()->json($coupon->toArray());
    }
}
