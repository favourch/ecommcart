<?php

namespace App;

use App\Common\Imageable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manufacturer extends Model
{
    use SoftDeletes, Imageable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'manufacturers';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'shop_id',
                            'name',
                            'slug',
                            'email',
                            'url',
                            'phone',
                            'description',
                            'country_id',
                            'active'
                        ];

    /**
     * Get the country for the manufacturer.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the products for the manufacturer.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get all of the inventories for the country.
     */
    public function inventories()
    {
        return $this->hasManyThrough(Inventory::class, Product::class);
    }

    /**
     * Setters
     */
    // public function setSlugAttribute($value)
    // {
    //     $this->attributes['slug'] = str_slug($value);
    // }

    /**
     * Scope a query to only include records from the users shop.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMine($query)
    {
        return $query->where('shop_id', Auth::user()->merchantId());
    }

    /**
     * Scope a query to only include active products.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
