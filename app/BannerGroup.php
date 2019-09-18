<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BannerGroup extends Model
{
    protected $table = 'banner_groups';

    /**
     * The primanry key is not incrementing
     *
     * @var boolean
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'name',
                ];

    /**
     * Group has many banners
     */
    public function banners()
    {
        return $this->hasMany(Banner::class, 'group_id');
    }
}
