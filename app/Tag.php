<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

	/**
     * Get all of the customers that are assigned this tag.
     */
    public function customers()
    {
        return $this->morphedByMany(App\Customer::class, 'taggable');
    }

    /**
     * Get all of the shops that are assigned this tag.
     */
    public function shops()
    {
        return $this->morphedByMany(App\Shop::class, 'taggable');
    }

    /**
     * Get all of the suppliers that are assigned this tag.
     */
    public function suppliers()
    {
        return $this->morphedByMany(App\Supplier::class, 'taggable');
    }

    /**
     * Get all of the products that are assigned this tag.
     */
    public function products()
    {
        return $this->morphedByMany(App\Product::class, 'taggable');
    }

    /**
     * Get all of the manufacturers that are assigned this tag.
     */
    public function manufacturers()
    {
        return $this->morphedByMany(App\Manufacturer::class, 'taggable');
    }

    /**
     * Get all of the blogs that are assigned this tag.
     */
    public function blogs()
    {
        return $this->morphedByMany(App\Blog::class, 'taggable');
    }

}
