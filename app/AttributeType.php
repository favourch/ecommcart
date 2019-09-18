<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeType extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'attribute_types';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * AttributeType has many Attributes
     */
    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }

}
