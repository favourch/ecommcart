<?php

namespace App\Http\Controllers\Api;

use DB;
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
use App\Events\Order\OrderCreated;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Requests\Validations\DirectCheckoutRequest;

class CheckoutController extends Controller
{
    /**
     * Checkout the specified cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request, Cart $cart)
    {
        if( !crosscheckCartOwnership($request, $cart) )
            return response()->json(['message' => trans('theme.notify.please_login_to_checkout')], 404);

        // Update the cart
        $cart->shipping_rate_id = $request->shipping_option_id;
        $cart->packaging_id = $request->packaging_id;
        $cart->payment_method_id = $request->payment_method_id;

        if($request->shipping_option_id)
            $cart->shipping = getShippingingCost($request->shipping_option_id);

        if($request->packaging_id)
            $cart->packaging = getPackagingCost($request->packaging_id);

        $cart->save();

        $cart = crosscheckAndUpdateOldCartInfo($request, $cart);

        // Start transaction!
        DB::beginTransaction();
        try {
            // Create the order from the cart
            $order = saveOrderFromCart($request, $cart);

        } catch(\Exception $e){
            \Log::error($e);        // Log the error

            // rollback the transaction and log the error
            DB::rollback();

            return response()->json(trans('theme.notify.order_creation_failed'), 500);
        }

        // Everything is fine. Now commit the transaction
        DB::commit();

        $cart->forceDelete();   // Delete the cart

        event(new OrderCreated($order));   // Trigger the Event

        return new OrderResource($order);
    }

    /**
     * Direct checkout with the item/cart
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  str $slug
     *
     * @return \Illuminate\Http\Response
     */
    // public function directCheckout(DirectCheckoutRequest $request, $slug)
    // {
    //     $cart = $this->addToCart($request, $slug);

    //     if (200 == $cart->status())
    //         return redirect()->route('cart.index', $cart->getdata()->id);
    //     else if (444 == $cart->status())
    //         return redirect()->route('cart.index', $cart->getdata()->cart_id);

    //     return redirect()->back()->with('warning', trans('theme.notify.failed'));
    // }

}
