<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'wishlists';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'customer_id',
                    'product_id',
                    'inventory_id',
                ];

    /**
     * Get the customer for the list.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the inventory for the list.
     */
    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    /**
     * Get the product for the list.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the wilshlist of the customer
     */
    public function scopeOfCustomer($query, $customer)
    {
        return $query->where('customer_id', $customer);
    }

    public function scopeByProduct($query, $product_id)
    {
        return $query->where('product_id', $product_id);
    }


    /**
     * Scope a query to only include records from the users shop.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMine($query)
    {
        return $query->where('customer_id', \Auth::guard('customer')->user()->id);
    }
}
