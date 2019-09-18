<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'modules';

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        if( ! Auth::user()->isSuperAdmin() ){
            static::addGlobalScope('NotSuperAdminModule', function (Builder $builder) {
                $builder->where('access', '!=', 'Super Admin');
            });
        }
    }

    /**
     * Get the permissions for the shop.
     */
    public function permissions()
    {
        return $this->hasMany('App\Permission');
    }

    /**
     * Scope a query to only include active modules.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    // /**
    //  * Get all of the users for the module.
    //  */
    // public function users()
    // {
    //     return $this->hasManyThrough('App\User', 'App\Role');
    // }


}
