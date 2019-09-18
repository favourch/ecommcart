<?php

namespace App;

use Hash;
use App\Common\Imageable;
use App\Common\Addressable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
// use Spatie\Activitylog\Traits\HasActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

// class User extends Authenticatable implements MustVerifyEmail
class User extends Authenticatable
{
    use SoftDeletes, HasApiTokens, Notifiable, Addressable, Imageable;

   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
                    'password',
                    'remember_token',
                    'verification_token',
                ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'dob'           => 'date',
        'deleted_at'    => 'datetime',
        'last_visited_at' => 'datetime',
        'read_announcements_at' => 'datetime',
        'active'        => 'boolean',
    ];

    /**
     * The attributes that will be logged on activity logger.
     *
     * @var boolean
     */
    protected static $logFillable = true;

    /**
     * The only attributes that has been changed.
     *
     * @var boolean
     */
    protected static $logOnlyDirty = true;

    /**
     * The name that will be used when log this model. (optional)
     *
     * @var boolean
     */
    protected static $logName = 'user';

    /**
     * Route notifications for the mail channel.
     *
     * @return string
     */
    public function routeNotificationForMail()
    {
        return $this->email;
    }

    /**
     * Route notifications for the Nexmo channel.
     *
     * @return string
     */
    public function routeNotificationForNexmo()
    {
        return $this->primaryAddress->phone;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'shop_id',
                    'role_id',
                    'name',
                    'nice_name',
                    'email',
                    'password',
                    'dob',
                    'description',
                    'sex',
                    'active',
                    'last_visited_at',
                    'last_visited_from',
                    'read_announcements_at',
                    'remember_token',
                    'verification_token',
                ];

    /**
     * Get the dashboard of the user.
     */
    public function dashboard()
    {
        return $this->hasOne(Dashboard::class, 'user_id');
    }

    /**
     * Get all of the country for the country.
     */
    public function country()
    {
        return $this->hasManyThrough(Country::class, Address::class, 'addressable_id', 'country_name');
    }

    /**
     * Get the Roles associated with the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the shop associated with the user.
    */
    public function shop()
    {
        return $this->belongsTo(Shop::class)->withDefault();
    }

    /**
     * Get the shops the user own.
    */
    public function owns()
    {
        return $this->hasOne(Shop::class, 'owner_id')->withTrashed()->withDefault();
    }

    /**
     * Get the Warehouses associated with the user.
     */
    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class)->withTimestamps();
    }

    /**
     * Get the user incharges of the warehouses.
     */
    public function incharges()
    {
        return $this->hasMany(Warehouse::class, 'incharge');
    }

    /**
     * Get the user messages of the warehouses.
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'user_id');
    }

    public function assignedTickets()
    {
        return $this->hasMany(Ticket::class, 'assigned_to');
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

    /**
     * User has many blog post
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    /**
     * Get dob for the user.
     *
     * @return array
     */
    public function getDobAttribute($dob)
    {
        if($dob)
            return date('Y-m-d', strtotime($dob));
    }

    /**
     * Get role list for the user.
     *
     * @return array
     */
    public function getRoleListAttribute()
    {
        if (count($this->roles)) return $this->roles->pluck('id')->toArray();
    }

    /**
     * Set password for the user.
     *
     * @return array
     */
    public function setPasswordAttribute($password)
    {
        if(Hash::needsRehash($password))
            $this->attributes['password'] = bcrypt($password);
        else
            $this->attributes['password'] = $password;
    }

    /**
     * Get name the user.
     *
     * @return mix
     */
    public function getName()
    {
        return $this->nice_name ?: $this->name;
    }

    /**
     * Get merchant id for the user.
     *
     * @return mix
     */
    public function merchantId()
    {
        return $this->shop_id;
    }

    /**
     * Get current plan
     *
     * @return mix
     */
    public function getCurrentPlan()
    {
        if( ! $this->merchantId() )  return Null;

        $subscription = optional($this->shop->subscriptions)->first();

        if($subscription && $subscription->valid())
            return $subscription;

        return Null;
    }

    /**
     * Check if the user is the super admin
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->role_id == Role::SUPER_ADMIN;
    }

    /**
     * Check if the user is the super admin or admin
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->isSuperAdmin() || $this->role_id == Role::ADMIN;
    }

    /**
     * Check if the user is from main platform or not
     *
     * @return bool
     */
    public function isFromPlatform()
    {
        return ! $this->isMerchant() && ! $this->merchantId();
    }

    /**
     * Check if the user is from a Merchant or not
     *
     * @return bool
     */
    public function isFromMerchant()
    {
        return $this->isMerchant() || $this->merchantId();
    }

    /**
     * Check if the user is a Merchant
     *
     * @return bool
     */
    public function isMerchant()
    {
        return $this->role_id == Role::MERCHANT;
    }

    /**
     * Check if the user is Verified
     *
     * @return bool
     */
    public function isVerified()
    {
        return $this->verification_token == Null;
    }

    /**
     * Check if the user is has billing token
     *
     * @return bool
     */
    public function hasBillingToken()
    {
        return $this->merchantId() && $this->shop->hasStripeId();
    }

    /**
     * Check if the user has outrange plan
     *
     * @return bool
     */
    public function hasExpiredPlan()
    {
        if(!$this->merchantId())        return false;

        $subscription = $this->shop->subscriptions->first();

        if ($subscription && ! is_null($subscription->ends_at))
            return \Carbon\Carbon::now()->gt($subscription->ends_at);

        return false;
    }

    /**
     * Check if the user has outrange generic plan
     *
     * @return bool
     */
    public function hasExpiredOnGenericTrial()
    {
        return $this->shop->trial_ends_at && $this->shop->trial_ends_at->isPast();
    }

    /**
     * Check if the user is subscribed
     *
     * @return bool
     */
    public function isSubscribed()
    {
        if($this->isFromPlatform() || !$this->merchantId())
            return False;

        $subscription = optional($this->shop->subscriptions)->first();

        return $subscription && $subscription->valid() || $this->isOnGenericTrial();
    }

    /**
     * Check if the user is isOnGenericTrial without card
     *
     * @return bool
     */
    public function isOnGenericTrial()
    {
        return $this->shop->onGenericTrial();
    }

    /**
     * Check if the user is OnTrial
     *
     * @return bool
     */
    public function isOnTrial()
    {
        $subscription = $this->shop->subscriptions->first();

        return $subscription && $subscription->onTrial();
    }

    /**
     * Check if the user is onGracePeriod
     *
     * @return bool
     */
    public function isOnGracePeriod()
    {
        $subscription = $this->shop->subscriptions->first();

        return $subscription && $subscription->onGracePeriod();
    }

    /**
     * Check if access level the user
     *
     * @return bool
     */
    public function accessLevel()
    {
        return $this->role->level ? $this->role->level + 1 : Null;
    }

    /**
     * Activities for the loggable model
     *
     * @return [type] [description]
     */
    public function activities()
    {
        return $this->activity()->orderBy('created_at', 'desc')->get();
    }

    /**
     * Check if the user is the super admin
     *
     * @return bool
     */
    public function scopeNotSuperAdmin($query)
    {
        return $query->where('role_id', '!=', Role::SUPER_ADMIN);
    }

    /**
     * Scope a query to only include records from the users shop.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFromPlatform($query)
    {
        return $query->where('role_id', '!=', Role::MERCHANT)->where('shop_id', Null);
    }

    /**
     * Scope a query to only include records from the users shop.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMerchant($query)
    {
        return $query->where('role_id', Role::MERCHANT);
    }

    /**
     * Scope a query to only include records with lower privilege than the logged in user.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLevel($query)
    {
        return $query->whereHas('role', function($q)
        {
            if (Auth::user()->role->level)
                return $q->where('level', '>', Auth::user()->role->level)->orWhere('level', Null);

            return $q->whereNull('level');
        });
    }

    /**
     * Scope a query to also include merchant records.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithMerchant($query)
    {
        return $query->where('role_id', Role::MERCHANT)->orWhere('shop_id', Auth::user()->merchantId());
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
