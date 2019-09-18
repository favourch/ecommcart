<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'states';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the country of the state.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
