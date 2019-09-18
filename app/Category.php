<?php

namespace App;

use App\Common\Imageable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes, Imageable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'category_sub_group_id', 'slug', 'description', 'active', 'featured'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get all listings for the category.
     */
    public function listings()
    {
        return $this->belongsToMany(Inventory::class, 'category_product', null, 'product_id', null, 'product_id');
    }

    /**
     * Get the subGroups for the category.
     */
    public function subGroup()
    {
        return $this->belongsTo(CategorySubGroup::class, 'category_sub_group_id')->withTrashed();
    }
    // public function subGroups()
    // {
    //     return $this->belongsToMany(CategorySubGroup::class);
    // }

    /**
     * Get the products for the category.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * Setters
     */
    public function setFeaturedAttribute($value)
    {
        $this->attributes['featured'] = (bool) $value;
    }

    // /**
    //  * Get subGroups list for the category.
    //  *
    //  * @return array
    //  */
    // public function getCatSubGrpsAttribute()
    // {
    //     if (count($this->subGroups)) return $this->subGroups->pluck('id')->toArray();
    // }

    // public static function findBySlug($slug)
    // {
    //     return $this->where('slug', $slug)->firstOrFail();
    // }

    /**
     * Scope a query to only include Featured records.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }

    /**
     * Scope a query to only include active categories.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
