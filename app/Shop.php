<?php

namespace App;

use Carbon\Carbon;
use App\SubscriptionPlan;
use App\Common\Billable;
use App\Common\Loggable;
use App\Common\Imageable;
use App\Common\Addressable;
use App\Common\Feedbackable;
use App\Events\ShopCreated;
use App\Helpers\Statistics;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use SoftDeletes, Loggable, Notifiable, Addressable, Imageable, Feedbackable, Billable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'shops';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'trial_ends_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * The name that will be used when log this model. (optional)
     *
     * @var tring
     */
    protected static $logName = 'shop';

    /**
     * Record events only
     *
     * @var array
     */
    protected static $recordEvents = ['updated'];

    /**
     * The name that will be ignored when log this model.
     *
     * @var array
     */
    protected static $ignoreChangedAttributes = [
                            'stripe_id',
                            'card_brand',
                            'card_holder_name',
                            'trial_ends_at',
                            'updated_at'
                        ];

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'owner_id',
                    'name',
                    'legal_name',
                    'email',
                    'slug',
                    'description',
                    'external_url',
                    'timezone_id',
                    'current_billing_plan',
                    'stripe_id',
                    'card_holder_name',
                    'card_brand',
                    'card_last_four',
                    'trial_ends_at',
                    'active',
                ];

    /**
     * Get the user that owns the shop.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id')->withTrashed();
    }

    /**
     * Get the staffs for the shop.
     */
    public function staffs()
    {
        return $this->hasMany(User::class)->withTrashed();
    }

    /**
     * Get the config for the shop.
     */
    public function config()
    {
        return $this->hasOne(Config::class);
    }

    /**
     * Get current subscription plan of the shop.
     */
    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'current_billing_plan', 'plan_id')->withDefault();
    }

    /**
     * Get the warehouses for the product.
     */
    public function warehouses()
    {
        return $this->hasMany(Warehouse::class);
    }

    /**
     * Get the ShippingZones for the shop.
     */
    public function shippingZones()
    {
        return $this->hasMany(ShippingZone::class);
    }

    /**
     * Get the ShippingZones for the shop.
     */
    public function shipping_zones()
    {
        return $this->hasMany(ShippingZone::class);
    }

    /**
     * Get the carriers for the shop.
     */
    public function carriers()
    {
        return $this->hasMany(Carrier::class);
    }

    /**
     * Get the products for the shop.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the inventories for the shop.
     */
    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    /**
     * Get the orders for the shop.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get sold items count.
     *
     * @return integer
     */
    public function soldItemsCount()
    {
        return $this->orders->sum('pivot.quantity');
    }

    // public function top_listings()
    // {
    //     return $this->inventories->sum('pivot.quantity');

    //     return $this->hasManyThrough(
    //         Inventory::class,
    //         Order::class,
    //         'country_id', // Foreign key on users table...
    //         'user_id', // Foreign key on posts table...
    //         'id', // Local key on countries table...
    //         'id' // Local key on users table...
    //     );

    //     // return $this->belongsToMany(Inventory::class, 'order_items', 'inventory_id', 'order_id')
    //     //     ->selectRaw('parts.*, sum(project_part.count) as pivot_count')
    //     //     ->withTimestamps()
    //     //     ->groupBy('project_part.pivot_part_id');
    // }

    /**
     * Get the carts for the shop.
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Get the coupons for the customer.
     */
    public function coupons()
    {
        return $this->belongsToMany(Coupon::class)->withTimestamps();
    }

    /**
     * Get the user gift_cards.
     */
    public function gift_cards()
    {
        return $this->hasMany(GiftCard::class);
    }

    /**
     * Get the paymentMethods for the shop.
     */
    public function paymentMethods()
    {
        return $this->belongsToMany(PaymentMethod::class, 'shop_payment_methods', 'shop_id', 'payment_method_id')
        ->orderBy('order')->withTimestamps();
    }

    /**
     * Get the taxes for the shop.
     */
    public function taxes()
    {
        return $this->hasMany(Tax::class);
    }

    /**
     * Get the suppliers for the product.
     */
    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }

    /**
     * Get the packagings for the product.
     */
    public function packagings()
    {
        return $this->hasMany(Packaging::class);
    }

    /**
     * Get the activePackagings for the product.
     */
    public function activePackagings()
    {
        return $this->hasMany(Packaging::class)->where('active',1);
    }

    /**
     * Get the defaultPackaging for the product.
     */
    public function defaultPackaging()
    {
        return $this->hasOne(Packaging::class)->where('default',1)->withDefault();
    }

    public function revenue()
    {
        return $this->hasMany(Order::class)->selectRaw('SUM(total) as total, shop_id')->groupBy('shop_id');
    }

    /**
     * Get the stripe for the shop.
     */
    public function stripe()
    {
        return $this->hasOne(ConfigStripe::class, 'shop_id')->withDefault();
    }

    /**
     * Get the authorizeNet for the shop.
     */
    public function authorizeNet()
    {
        return $this->hasOne(ConfigAuthorizeNet::class, 'shop_id')->withDefault();
    }

    /**
     * Get the paypalExpress for the shop.
     */
    public function paypalExpress()
    {
        return $this->hasOne(ConfigPaypalExpress::class, 'shop_id')->withDefault();
    }

    /**
     * Get the instamojo for the shop.
     */
    public function instamojo()
    {
        return $this->hasOne(ConfigInstamojo::class, 'shop_id')->withDefault();
    }

    /**
     * Get the paystack for the shop.
     */
    public function paystack()
    {
        return $this->hasOne(ConfigPaystack::class, 'shop_id')->withDefault();
    }

   /**
     * Get the manualPaymentMethods for the shop.
     */
    public function manualPaymentMethods()
    {
        return $this->belongsToMany(PaymentMethod::class, 'config_manual_payments', 'shop_id', 'payment_method_id')
        ->withPivot('additional_details', 'payment_instructions')->withTimestamps();
    }

    /**
     * Get the timezone the shop.
     */
    public function timezone()
    {
        return $this->belongsTo(Timezone::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function openTickets()
    {
        return $this->tickets()->where('status', '<', Ticket::STATUS_SOLVED);
    }

    public function solvedTickets()
    {
        return $this->tickets()->where('status', '=', Ticket::STATUS_SOLVED);
    }

    public function closedTickets()
    {
        return $this->tickets()->where('status', '=', Ticket::STATUS_CLOSED);
    }

    public function disputes()
    {
        return $this->hasMany(Dispute::class);
    }

    public function openDisputes()
    {
        return $this->disputes()->where('status', '<', Dispute::STATUS_SOLVED);
    }

    public function solvedDisputes()
    {
        return $this->disputes()->where('status', '=', Dispute::STATUS_SOLVED);
    }

    public function closedDisputes()
    {
        return $this->disputes()->where('status', '=', Dispute::STATUS_CLOSED);
    }

    /**
     * Check if the current subscription plan allow to add more user
     *
     * @return bool
     */
    public function canAddMoreUser()
    {
        if($this->current_billing_plan){
            $plan = SubscriptionPlan::findOrFail($this->current_billing_plan);

            if(Statistics::shop_user_count() < $plan->team_size)
                return True;
        }

        return false;
    }

    /**
     * Check if the current subscription plan allow to add more Inventory
     *
     * @return bool
     */
    public function canAddMoreInventory()
    {
        if($this->current_billing_plan){
            $plan = SubscriptionPlan::findOrFail($this->current_billing_plan);

            if( Statistics::shop_inventories_count() < $plan->inventory_limit )
                return True;
        }

        return false;
    }

    // /**
    //  * Check if the current subscription plan allow to add more user
    //  *
    //  * @return bool
    //  */
    // public function uses()
    // {
    //     if($this->current_billing_plan){
    //         $plan = SubscriptionPlan::findOrFail($this->current_billing_plan);

    //         if(Statistics::shop_user_count() < $plan->team_size)
    //             return True;
    //     }

    //     return false;
    // }

    /**
     * Scope a query to only include active shops.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1)->where(function($q) {
            $q->whereNotNull('current_billing_plan')
            ->where(function($x) {
                $x->whereNull('trial_ends_at')->orWhere('trial_ends_at', '>', Carbon::now());
            });
        })
        ->whereHas('config', function ($q) {
            $q->live();
        })
        ->whereHas('paymentMethods');
    }

    /**
     * Activities for the loggable model
     *
     * @return [type] [description]
     */
    public function logs()
    {
        return $this->activities()->orderBy('created_at', 'desc')->get();
    }

    /**
     * Check if the system is down or live.
     *
     * @return bool
     */
    public function isDown()
    {
        return $this->config->maintenance_mode;
    }
}
