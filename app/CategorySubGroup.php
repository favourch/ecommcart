<?php

namespace App;

use App\Common\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategorySubGroup extends Model
{
    use SoftDeletes, CascadeSoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'category_group_id', 'slug', 'description', 'active'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Cascade Soft Deletes Relationships
     *
     * @var array
     */
    protected $cascadeDeletes = ['categories'];

    /**
     * Get the categoryGroup that owns the SubGroup.
     */
    public function group()
    {
        return $this->belongsTo(CategoryGroup::class, 'category_group_id')->withTrashed();
    }

    /**
     * Get the categories for the CategorySubGroup.
     */
    public function categories()
    {
        return $this->hasMany(Category::class, 'category_sub_group_id')->orderBy('name', 'asc');
        // return $this->belongsToMany(Category::class)->orderBy('name', 'asc')->withTimestamps();
    }

    // /**
    //  * Get all listings for the category.
    //  */
    // public function getListingsAttribute()
    // {
    //     return \DB::table('inventories')
    //     ->join('category_product', 'inventories.product_id', '=', 'category_product.product_id')
    //     ->select('inventories.*', 'category_product.category_id')
    //     ->where('category_product.category_id', '=', $this->id)->get();

    //     // return $this->belongsToMany(Inventory::class, 'category_product', null, 'product_id', null, 'product_id');
    // }

    /**
     * Scope a query to only include active categorySubGroups.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
