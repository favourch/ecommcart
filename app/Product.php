<?php

namespace App;

use Auth;
use App\Common\Taggable;
use App\Common\Imageable;
use App\Common\Feedbackable;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, Taggable, Imageable, Searchable, Feedbackable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that should be casted to boolean types.
     *
     * @var array
     */
    protected $casts = [
        'has_variant' => 'boolean',
        'requires_shipping' => 'boolean',
        'downloadable' => 'boolean',
    ];

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
                        'manufacturer_id',
                        'brand',
                        'name',
                        'model_number',
                        'mpn',
                        'gtin',
                        'gtin_type',
                        'description',
                        'min_price',
                        'max_price',
                        'origin_country',
                        'has_variant',
                        'requires_shipping',
                        'downloadable',
                        'slug',
                        // 'meta_title',
                        // 'meta_description',
                        'sale_count',
                        'active'
                    ];

    /**
     * Get the value used to index the model.
     *
     * @return mixed
     */
    public function getScoutKey()
    {
        return $this->name;
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        $array['id'] = $this->id;
        $array['shop_id'] = $this->shop_id;
        $array['manufacturer_id'] = $this->manufacturer_id;
        $array['name'] = $this->name;
        $array['model_number'] = $this->model_number;
        $array['mpn'] = $this->mpn;
        $array['gtin'] = $this->gtin;
        $array['description'] = $this->description;
        $array['active'] = $this->active;

        return $array;
    }

    /**
     * Overwrited the image method in the imageable
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function image()
    {
        return $this->morphOne(\App\Image::class, 'imageable')
        ->where(function($q){
            $q->whereNull('featured')->orWhere('featured', 0);
        })->orderBy('order', 'asc');
    }

    /**
     * Get the origin associated with the product.
     */
    public function origin()
    {
        return $this->belongsTo(Country::class, 'origin_country');
    }

    /**
     * Get the manufacturer associated with the product.
     */
    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class)->withDefault();
    }

    /**
     * Get the shop associated with the product.
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    /**
     * Get the categories for the product.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    /**
     * Get the inventories for the product.
     */
    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    /**
     * Set the requires_shipping for the Product.
     */
    public function setHasVariantAttribute($value)
    {
        $this->attributes['has_variant'] = (bool) $value;
    }

    /**
     * Set the requires_shipping for the Product.
     */
    public function setRequiresShippingAttribute($value)
    {
        $this->attributes['requires_shipping'] = (bool) $value;
    }

    /**
     * Set the downloadable for the Product.
     */
    public function setDownloadableAttribute($value)
    {
        $this->attributes['downloadable'] = (bool) $value;
    }

    /**
     * Get the category list for the product.
     *
     * @return array
     */
    public function getCategoryListAttribute()
    {
        if (count($this->categories)) return $this->categories->pluck('id')->toArray();
    }

    /**
     * Set the Minimum price zero if the value is Null.
     */
    public function setMinPriceAttribute($value)
    {
        $this->attributes['min_price'] = $value ? $value : 0;
    }

    /**
     * Set the Maximum price null if the value is zero.
     */
    public function setMaxPriceAttribute($value)
    {
        $this->attributes['max_price'] = (bool) $value ? $value : Null;
    }

    /**
     * Get the formate decimal.
     *
     * @return array
     */
    // public function getMinPriceAttribute($attribute)
    // {
    //      return get_formated_decimal($attribute);
    // }
    // public function getMaxPriceAttribute($attribute)
    // {
    //      return $attribute ? get_formated_decimal($attribute) : $attribute;
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
