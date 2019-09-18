<?php

namespace App;

use App\Common\Imageable;
use App\Common\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryGroup extends Model
{
    use SoftDeletes, CascadeSoftDeletes, Imageable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'slug', 'icon', 'order', 'active'];

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
    protected $cascadeDeletes = ['subGroups'];

    /**
     * Get the subGroups associated with the CategoryGroup.
    */
    public function subGroups()
    {
        return $this->hasMany(CategorySubGroup::class, 'category_group_id');
    }

    /**
     * Get the categories associated with the CategoryGroup.
    */
    public function categories()
    {
        return $this->hasManyThrough(Category::class, CategorySubGroup::class,
            'category_group_id', // Foreign key on CategorySubGroup table...
            'category_sub_group_id', // Foreign key on Category table...
            'id', // Local key on CategoryGroup table...
            'id' // Local key on CategorySubGroup table...
        );
    }

    /**
     * Setters
     */
    public function setOrderAttribute($value)
    {
        $this->attributes['order'] = $value ?: 100;
    }

    /**
     * Scope a query to only include active categoryGroups.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

}
