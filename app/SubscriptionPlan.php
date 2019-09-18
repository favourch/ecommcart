<?php

namespace App;

use App\Events\Subscription\Saving;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionPlan extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subscription_plans';

    /**
     * The database primary key used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'plan_id';

    /**
     * The primanry key is not incrementing
     *
     * @var boolean
     */
    public $incrementing = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['deleted_at'];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'saving' => Saving::class,
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'deleted_at' => 'date',
        'featured' => 'boolean',
    ];

    /**
     * Get the Shops associated with the plan.
     */
    public function shops()
    {
        return $this->hasMany(Shop::class, 'current_billing_plan', 'plan_id');
    }

    /**
     * Check if the plan is the featured
     *
     * @return bool
     */
    public function isFeatured()
    {
        return $this->featured;
    }

    /**
     * Set the featured value.
     */
    public function setFeaturedAttribute($value)
    {
        $this->attributes['featured'] = (bool) $value;
    }
}
