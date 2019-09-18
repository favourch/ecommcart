<?php

namespace App;

use App\Common\Imageable;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use Imageable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'banners';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'title',
                    'description',
                    'link',
                    'link_label',
                    'bg_color',
                    'group_id',
                    'columns',
                    'order',
                ];

    /**
     * Get the group for the banner.
     */
    public function group()
    {
        return $this->belongsTo(BannerGroup::class);
    }

    /**
     * Setters
     */
    public function setOrderAttribute($value)
    {
        $this->attributes['order'] = $value ?: 100;
    }

    // public function setOptionsAttribute($value)
    // {
    //     $this->attributes['options'] = serialize($value);
    // }

    // /**
    //  * Getters
    //  */
    // public function getOptionsAttribute($value)
    // {
    //     return unserialize($value);
    // }

}
