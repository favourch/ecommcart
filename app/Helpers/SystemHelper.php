<?php

use Carbon\Carbon;
use App\Cart;
use App\Order;
use App\Coupon;
use App\Visitor;
use App\Packaging;
use App\ShippingRate;
use Illuminate\Support\Str;
use App\Helpers\ListHelper;
use Laravel\Cashier\Cashier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client as HttpClient;

if ( ! function_exists('getPlatformFeeForOrder') )
{
    /**
     * return calculated application fee for the given order value
     */
    function getPlatformFeeForOrder($order)
    {
        if ( ! $order instanceof Order )
            $order = Order::findOrFail($order);

        $plan = $order->shop->plan;

        $commission = ($plan->marketplace_commission > 0) ? ($order->total * $plan->marketplace_commission)/100 : 0;

        return ($commission + $plan->transaction_fee );
    }
}

if ( ! function_exists('updateVisitorTable') )
{
    /**
     * Set system settings into the config
     */
    function updateVisitorTable(Request $request)
    {
        // $ip = '103.49.170.142'; //Temp for test

        $ip = $request->ip();
        $visitor = Visitor::withTrashed()->find($ip);

        if( ! $visitor ){
            $visitor = new Visitor;

            // Get country code
            if(check_internet_connection()){
                $response = (new HttpClient)->get('http://ip2c.org/?ip='.$ip);
                $body = (string) $response->getBody();
                if ($body[0] === '1'){
                    $visitor->country_code = explode(';', $body)[1];
                }
            }
            $visitor->ip = $ip;
            $visitor->hits = 1;
            $visitor->page_views = 1;
            $visitor->info = $request->header('User-Agent');

            return $visitor->save();
        }

        // Blocked Ip
        if($visitor->deleted_at){
            abort(403, trans('responses.you_are_blocked'));
        }

        // Increase the hits value if this visit is the first visit for today
        if($visitor->updated_at->lt(\Carbon\Carbon::today())){
            $visitor->hits++;
            $visitor->info = $request->header('User-Agent');
            // $visitor->mac = $request->mac();
            // $visitor->device = $request->device();
            // $visitor->country_code = $request->country_code();
        }

        $visitor->page_views++;

        return $visitor->save();
    }
}

if ( ! function_exists('setSystemConfig') )
{
    /**
     * Set system settings into the config
     */
    function setSystemConfig($shop = Null)
    {
        if(!config('system_settings')){
            $system_settings = ListHelper::system_settings();

            config()->set('system_settings', $system_settings);

            setSystemCurrency();
        }

        if($shop && !config('shop_settings')){
            setShopConfig($shop);
        }
    }
}

if ( ! function_exists('setSystemCurrency') )
{
    /**
     * Set system currency into the config
     */
    function setSystemCurrency()
    {
        $currency = DB::table('currencies')->where('id', config('system_settings.currency_id'))->first();

        // Set Cashier Currency
        Cashier::useCurrency($currency->iso_code, $currency->symbol);

        config([
            'system_settings.currency' => [
                'name' => $currency->name,
                'symbol' => $currency->symbol,
                'iso_code' => $currency->iso_code,
                'symbol_first' => $currency->symbol_first,
                'decimal_mark' => $currency->decimal_mark,
                'thousands_separator' => $currency->thousands_separator,
                'subunit' => $currency->subunit,
            ]
        ]);
    }
}

if ( ! function_exists('setDashboardConfig') )
{
    /**
     * Set dashboard settings into the config
     */
    function setDashboardConfig($dash = Null)
    {
        // Unset unwanted values
        unset($dash['user_id'],$dash['created_at']);

        config()->set('dashboard', $dash);
    }
}

if ( ! function_exists('setShopConfig') )
{
    /**
     * Set shop settings into the config
     */
    function setShopConfig($shop = Null)
    {
        if(!config('shop_settings')){
            $shop_settings = ListHelper::shop_settings($shop);

            config()->set('shop_settings', $shop_settings);
        }
    }
}

if ( ! function_exists('getShopConfig') )
{
    /**
     * Return config value for the given shop and column
     *
     * @param $int packaging
     */
    function getShopConfig($shop, $column)
    {
        if( config('shop_settings') && array_key_exists($column, config('shop_settings')) )
           return config('shop_settings.' . $column);

        return \DB::table('configs')->where('shop_id', $shop)->value($column);
    }
}

if ( ! function_exists('getMysqliConnection') )
{
    /**
     * Return Mysqli connection object
     */
    function getMysqliConnection()
    {
        return mysqli_connect(env('DB_HOST', '127.0.0.1'), env('DB_USERNAME', 'root'), env('DB_PASSWORD', 'root'), env('DB_DATABASE'), env('DB_PORT', '3306'));
    }
}

if ( ! function_exists('setAdditionalCartInfo') )
{
    /**
     * Push some extra information into the request
     *
     * @param $request
     */
    function setAdditionalCartInfo($request)
    {
        $total = 0;
        $grand_total = 0;
        $shipping_weight = 0;
        $handling = config('shop_settings.order_handling_cost');

        foreach ($request->input('cart') as $cart){
            $total = $total + ($cart['quantity'] * $cart['unit_price']);
            $shipping_weight += $cart['shipping_weight'];
        }

        $grand_total =  ($total + $handling + $request->input('shipping') + $request->input('packaging') + $request->input('taxes')) - $request->input('discount');

        $request->merge([
            'shop_id' => $request->user()->merchantId(),
            'shipping_weight' => $shipping_weight,
            'item_count' => count( $request->input('cart') ),
            'quantity' => array_sum( array_column( $request->input('cart'), 'quantity' ) ),
            'total' => $total,
            'handling' => $handling,
            'grand_total' => $grand_total,
            'billing_address' => $request->input('same_as_shipping_address') ?
                                $request->input('shipping_address') : $request->input('billing_address'),
            'approved' => 1,
        ]);

        return $request;
    }
}

if ( ! function_exists('saveOrderFromCart') )
{
    /**
     * Create a new order from the cart
     *
     * @param  Request $request
     * @param  App\Cart $cart
     *
     * @return App\Order
     */
    function saveOrderFromCart($request, $cart)
    {
        // Set shipping_rate_id and handling cost to NULL if its free shipping
        if($cart->is_free_shipping()) {
            $cart->shipping_rate_id = Null;
            $cart->handling = Null;
        }

        // Save the order
        $order = new Order;
        $order->fill(
            array_merge($cart->toArray(), [
                'grand_total' => $cart->grand_total(),
                'order_number' => get_formated_order_number($cart->shop_id),
                'carrier_id' => $cart->carrier() ? $cart->carrier->id : NULL,
                'shipping_address' => $request->shipping_address,
                'billing_address' => $request->shipping_address,
                'email' => $request->email,
                'buyer_note' => $request->buyer_note
            ])
        );
        $order->save();

        // Add order item into pivot table
        $cart_items = $cart->inventories->pluck('pivot');
        $order_items = [];
        foreach ($cart_items as $item) {
            $order_items[] = [
                'order_id'          => $order->id,
                'inventory_id'      => $item->inventory_id,
                'item_description'  => $item->item_description,
                'quantity'          => $item->quantity,
                'unit_price'        => $item->unit_price,
                'created_at'        => $item->created_at,
                'updated_at'        => $item->updated_at,
            ];
        }
        \DB::table('order_items')->insert($order_items);

         // Sync up the inventory. Decrease the stock of the order items from the listing
        foreach ($order->inventories as $item) {
            $item->decrement('stock_quantity', $item->pivot->quantity);
        }


        // Reduce the coupone in use
        if ($order->coupon_id)
            Coupon::find($order->coupon_id)->decrement('quantity');
            // \DB::table('coupons')->where('id', $order->coupon_id)->decrement('quantity');

        return $order;
    }
}

if ( ! function_exists('revertOrderAndMoveToCart') )
{
    /**
     * Revert order to cart
     *
     * @param  App\Order $Order
     *
     * @return App\Cart
     */
    function revertOrderAndMoveToCart($order)
    {
        if( !$order instanceOf Order )
            $order = Order::find($order);

        if (!$order) return;

        // Save the cart
        $cart = Cart::create(array_merge($order->toArray(), ['ip_address' => request()->ip()]));

        // Add order item into pivot table
        $order_items = $order->inventories->pluck('pivot');
        $cart_items = [];
        foreach ($order_items as $item) {
            $cart_items[] = [
                'cart_id'           => $cart->id,
                'inventory_id'      => $item->inventory_id,
                'item_description'  => $item->item_description,
                'quantity'          => $item->quantity,
                'unit_price'        => $item->unit_price,
                'created_at'        => $item->created_at,
                'updated_at'        => $item->updated_at,
            ];
        }
        \DB::table('cart_items')->insert($cart_items);

        // Increment the coupone in use
        if ($order->coupon_id)
            Coupon::find($order->coupon_id)->increment('quantity');

        $order->forceDelete();   // Delete the order

        return $cart;
    }
}

if ( ! function_exists('prepareFilteredListings') )
{
    /**
     * Prepare Result result for front end
     *
     * @param  Request $request
     * @param  collection $items
     *
     * @return collection
     */
    function prepareFilteredListings($request, $categoryGroup)
    {
        $t_listings = [];
        foreach ($categoryGroup->categories as $t_category) {
            $t_products = $t_category->listings()->available()->filter($request->all())
            ->withCount(['feedbacks', 'orders' => function($query){
                $query->where('order_items.created_at', '>=', Carbon::now()->subHours(config('system.popular.hot_item.period', 24)));
            }])
            ->with(['feedbacks:rating,feedbackable_id,feedbackable_type', 'images:path,imageable_id,imageable_type'])->get();

            foreach ($t_products as $t_product)
                $t_listings[] = $t_product;
        }

        return collect($t_listings);
    }
}

if ( ! function_exists('crosscheckCartOwnership') )
{
    /**
     * Crosscheck the cart ownership
     *
     * @param \App\Cart $cart
     */
    function crosscheckCartOwnership($request, Cart $cart)
    {
        $return = $cart->customer_id == Null && $cart->ip_address == request()->ip();

        if(Auth::guard('customer')->check())
            return  $return || ($cart->customer_id == Auth::guard('customer')->user()->id);

        return $return;
    }
}

if ( ! function_exists('crosscheckAndUpdateOldCartInfo') )
{
    /**
     * Crosscheck old cart info with current listing and update
     *
     * @param \App\Cart $cart
     */
    function crosscheckAndUpdateOldCartInfo($request, Cart $cart)
    {
        $total = 0;
        $quantity = 0;
        $discount = Null;
        $shipping_weight = 0;
        $handling = getShopConfig($cart->shop_id, 'order_handling_cost');
        // Start with old values
        $shipping = $cart->shipping;
        $packaging = $cart->packaging;
        // $discount = $cart->discount;

        // Qtt and Total
        foreach ($cart->inventories as $item) {
            $temp_qtt = $request->quantity ? $request->quantity[$item->id] : $item->pivot->quantity;
            $unit_price = $item->currnt_sale_price();
            $temp_total = $unit_price * $temp_qtt;

            $shipping_weight = $item->shipping_weight * $temp_qtt;
            $quantity += $temp_qtt;
            $total += $temp_total;

            // Update the cart item pivot table
            $cart->inventories()->updateExistingPivot($item->id, ['quantity' => $temp_qtt, 'unit_price' => $unit_price]);
        }

        // Taxes
        if($request->zone_id) {
            $taxrate = $request->tax_id ? getTaxRate($request->tax_id) : Null;
            $taxes = ($total * $taxrate)/100;

            $cart->shipping_zone_id = $request->zone_id;
            $cart->taxrate = $taxrate;
        }
        else{
            $taxes = ($total * $cart->taxrate)/100;
        }

        // Shipping
        if($request->shipping_rate_id) {
            $shippingRate = ShippingRate::select('rate')->where([
                ['id', '=', $request->shipping_rate_id],
                ['shipping_zone_id', '=', $request->zone_id]
            ])->first();

            // abort_unless( $shippingRate, 403, trans('theme.notify.seller_doesnt_ship') );

            if($shippingRate){
                $shipping = $shippingRate->rate;
                $cart->shipping_rate_id = $request->shipping_rate_id;
            }
            else{
                $cart->shipping_rate_id = Null;
            }
        }

        // Discount
        if($request->discount_id) {
            $coupon = Coupon::where([
                ['id', '=', $request->discount_id],
                ['shop_id', '=', $cart->shop_id],
                ['code', '=', $request->coupon]
            ])->active()->first();

            if($coupon && $coupon->isValidForTheCart($total, $request->zone_id)){
                $discount = ('percent' == $coupon->type) ? ($coupon->value * ($total/100)) : $coupon->value;
                $cart->coupon_id = $request->discount_id;
            }
        }
        else if($cart->coupon_id){
            // Validate the old coupon
            if($cart->coupon->isValidForTheCart($total, $request->zone_id)){
                $discount = ('percent' == $cart->coupon->type) ? ($cart->coupon->value * ($total/100)) : $cart->coupon->value;
            }
            // Validation failed
            else{
                $cart->coupon_id = Null;
            }
        }

        // Packaging
        if($request->packaging_id && $request->packaging_id != Packaging::FREE_PACKAGING_ID) {
            $packagingCost = Packaging::select('cost')->where([
                ['id', '=', $request->packaging_id],
                ['shop_id', '=', $cart->shop_id]
            ])->active()->first();

            $packaging = $packagingCost->cost;
            $cart->packaging_id = $request->packaging_id;
        }

        if ($request->payment_method) {
            $cart->payment_method_id = $request->payment_method;
        }

        // Set customer_id if not set yet
        if( ! $cart->customer_id && Auth::guard('customer')->check() )
            $cart->customer_id = Auth::guard('customer')->user()->id;

        $cart->ship_to = $request->ship_to ?? $request->country_id ?? $cart->ship_to;
        $cart->shipping_weight = $shipping_weight;
        $cart->quantity = $quantity;
        $cart->total = $total;
        $cart->taxes = $taxes;
        $cart->shipping = $shipping;
        $cart->packaging = $packaging;
        $cart->discount = $discount;
        $cart->handling = $handling;
        $cart->grand_total = ($total + $taxes + $shipping + $packaging + $handling) - $discount;
        $cart->save();

        return $cart;
    }
}

if ( ! function_exists('generate_combinations') )
{
    /**
     * Generate all the possible combinations among a set of nested arrays.
     *
     * @param  array   $data  The entrypoint array container.
     * @param  array   &$all  The final container (used internally).
     * @param  array   $group The sub container (used internally).
     * @param  int     $k     The actual key for value to append (used internally).
     * @param  string  $value The value to append (used internally).
     * @param  integer $i     The key index (used internally).
     * @param  int     $key   The kay of parent array (used internally).
     * @return array          The result array with all posible combinations.
     */
    function generate_combinations(array $data, array &$all = [], array $group = [], $k = null, $value = null, $i = 0, $key = null)
    {
        $keys = array_keys($data);

        if ((isset($value) === true) && (isset($k) === true)) {
            $group[$key][$k] = $value;
        }

        if ($i >= count($data)){
            array_push($all, $group);
        }
        else {
            $currentKey = $keys[$i];

            $currentElement = $data[$currentKey];

            if(count($currentElement) <= 0){
                generate_combinations($data, $all, $group, null, null, $i + 1, $currentKey);
            }
            else{
                foreach ($currentElement as $k => $val){
                    generate_combinations($data, $all, $group, $k, $val, $i + 1, $currentKey);
                }
            }
        }

        return $all;
    }
}

if ( ! function_exists('get_activity_str') )
{
    function get_activity_str($model, $attrbute, $new, $old){
        // \Log::info($attrbute);
        switch ($attrbute) {
            case 'trial_ends_at':
                return trans('app.activities.trial_started');
                break;

            case 'current_billing_plan':
                $plan = \App\SubscriptionPlan::find([$old, $new])->pluck('name', 'plan_id');

                if(is_null($old))
                    return trans('app.activities.subscribed', ['plan' => $plan[$new]]);

                return trans('app.activities.subscription_changed', ['from' => $plan[$old], 'to' => $plan[$new]]);
                break;

            case 'card_last_four':
                if(is_null($old))
                    return trans('app.activities.billing_info_added', ['by' => $new]);

                return trans('app.activities.billing_info_changed', ['from' => $old, 'to' => $new]);
                break;

            case 'order_status_id':
                $attrbute = trans('app.status');
                if($old){
                    $statues = \App\OrderStatus::find([$old, $new])->pluck('name', 'id');
                    $old  = $statues[$old];
                } else {
                    $statues = \App\OrderStatus::find($new)->pluck('name', 'id');
                }
                $new  = $statues[$new];
                break;

            case 'payment_status':
                $attrbute = trans('app.payment_status');
                $old  = get_payment_status_name($old);
                $new  = get_payment_status_name($new);
                break;

            case 'carrier_id':
                $attrbute = trans('app.shipping_carrier');

                if(is_null($old)){
                    $carrier = \App\Carrier::find($new)->pluck('name', 'id');
                }
                else {
                    $carrier = \App\Carrier::find([$old, $new])->pluck('name', 'id');
                    $old  = $carrier[$old];
                }
                $new  = $carrier[$new];
                break;

            case 'tracking_id':
                $attrbute = trans('app.tracking_id');
                break;

            case 'timezone_id':
                $attrbute = trans('app.timezone');
                $old  = get_value_from($old, 'timezones', 'value');
                $new  = get_value_from($new, 'timezones', 'value');
                break;

            case 'status':
                $attrbute = trans('app.status');
                if(class_basename($model) == 'Dispute'){
                    $old  = get_disput_status_name($old);
                    $new  = get_disput_status_name($new);
                }
                break;

            default:
                $attrbute = title_case(str_replace('_', ' ', $attrbute));
                break;
        }

        if($old)
            return trans('app.activities.updated', ['key' => $attrbute, 'from' => $old, 'to' => $new]);
        else
            return trans('app.activities.added', ['key' => $attrbute, 'value' => $new]);
    }
}