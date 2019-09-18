<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visitor extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'visitors';

    /**
     * The database primary key used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'ip';

    /**
     * The primanry key is not incrementing
     *
     * @var boolean
     */
    public $incrementing = false;

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'maintenance_mode' => 'boolean',
    // ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the user carts.
     */
    public function carts()
    {
        return $this->hasMany(Cart::class, 'ip_address');
    }

    /**
     * Check if the ip is blocked.
     */
    public function isBlocked()
    {
        return $this->deleted_at;
    }

    /**
     * Setters
     */
    public function setInfoAttribute($value)
    {
        $this->attributes['info'] = serialize($value);
    }

    /**
     * Getters
     */
    public function getInfoAttribute($value)
    {
        return unserialize($value);
    }

    /**
     * Scope a query to only include records that have the given date.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOf($query, Carbon $date)
    {
        return $query->withTrashed()->where('updated_at', '>=', $date);
    }

    /**
     * Scope a query to only include blocked ips.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBlocked($query)
    {
        return $query->whereNotNull('deleted_at');
    }
}
