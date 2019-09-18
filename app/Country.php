<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'countries';

    /**
     * Get all of the states for the country.
     */
    public function states()
    {
        return $this->hasMany(State::class);
    }

    /**
     * Get all of the manufacturer for the country.
     */
    public function manufacturer()
    {
        return $this->hasMany(Manufacturer::class);
    }

    /**
     * Get the products for the country.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'origin_country');
    }

    /**
     * Get all of the users for the country.
     */
    public function users()
    {
        return $this->hasManyThrough(User::class, Address::class);
        // return $this->hasManyThrough(User', Address', 'addressable_id', 'country_name');
    }

    /**
     * Get all of the customers for the country.
     */
    public function customers()
    {
        return $this->hasManyThrough(Customer::class, Address::class);
        // return $this->hasManyThrough(Customer::class, Address::class, 'addressable_id', 'country_name');
    }

    /**
     * Get the addresses the country.
    */
    public function addresses()
    {
        // return $this->belongsTo(Address', 'country_name' , 'name');
        return $this->hasMany(Address::class);
    }

    /**
     * Scope a query to only include active countries.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

}
