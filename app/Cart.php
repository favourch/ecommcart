<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'carts';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Load item count with cart
     *
     * @var array
     */
    protected $withCount = ['inventories'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                        'shop_id',
                        'customer_id',
                        'ip_address',
                        'ship_to',
                        'shipping_zone_id',
                        'shipping_rate_id',
                        'packaging_id',
                        'taxrate',
                        'item_count',
                        'quantity',
                        'total',
                        'discount',
                        'shipping',
                        'packaging',
                        'handling',
                        'taxes',
                        'grand_total',
                        'shipping_weight',
                        'shipping_address',
                        'billing_address',
                        'coupon_id',
                        'payment_method_id',
                        'payment_status',
                        'message_to_customer',
                        'admin_note',
                    ];

    /**
     * Get the country associated with the order.
     */
    public function shipTo()
    {
        return $this->belongsTo(Country::class, 'ship_to');
    }

    /**
     * Get the customer associated with the cart.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class)->withDefault([
            'name' => trans('app.guest_customer'),
        ]);
    }

    /**
     * Get the shop associated with the cart.
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class)->withDefault();
    }

    /**
     * Fetch billing address
     *
     * @return Address or null
     */
    public function billingAddress()
    {
        return $this->belongsTo(Address::class, 'billing_address');
    }

    /**
     * Fetch billing address
     *
     * @return Address or null
     */
    public function shippingAddress()
    {
        return $this->belongsTo(Address::class, 'shipping_address');
    }

    /**
     * Get the shippingZone for the order.
     */
    public function shippingZone()
    {
        return $this->belongsTo(ShippingZone::class, 'shipping_zone_id');
    }

    /**
     * Get the shippingRate for the order.
     */
    public function shippingRate()
    {
        return $this->belongsTo(ShippingRate::class, 'shipping_rate_id');
    }

    /**
     * Get the packaging for the order.
     */
    public function shippingPackage()
    {
        return $this->belongsTo(Packaging::class, 'packaging_id');
    }

    /**
     * Get the carrier associated with the cart.
     */
    public function carrier()
    {
        return optional($this->shippingRate)->carrier();
    }

    /**
     * Get the coupon associated with the order.
     */
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    /**
     * Get the inventories for the product.
     */
    public function inventories()
    {
        return $this->belongsToMany(Inventory::class, 'cart_items')
        ->withPivot('item_description', 'quantity', 'unit_price')->withTimestamps();
    }

    /**
     * Get the paymentMethod for the order.
     */
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    /**
     * Return shipping cost with handling fee
     *
     * @return number
     */
    public function get_shipping_cost()
    {
        return $this->is_free_shipping() ? 0 : $this->shipping + $this->handling;
    }

    /**
     * Return grand tolal
     *
     * @return number
     */
    public function grand_total()
    {
        if($this->is_free_shipping())
            return ($this->total + $this->taxes + $this->packaging) - $this->discount;

        return ($this->total + $this->handling + $this->taxes + $this->shipping + $this->packaging) - $this->discount;
    }

    /**
     * Check if the cart eligable for free shipping
     *
     * @return bool
     */
    public function is_free_shipping()
    {
        if( ! $this->shipping_rate_id )
            return TRUE;

        return FALSE;
    }

    /**
     * Setters
     */
    public function setDiscountAttribute($value){
        $this->attributes['discount'] = $value ?? Null;
    }
    public function setShippingAddressAttribute($value){
        $this->attributes['shipping_address'] = is_numeric($value) ? $value : Null;
    }
    public function setBillingAddressAttribute($value){
        $this->attributes['billing_address'] = is_numeric($value) ? $value : Null;
    }

    /**
     * Scope a query to only include records from the users shop.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMine($query)
    {
        return $query->where('shop_id', Auth::user()->merchantId());
    }
}
