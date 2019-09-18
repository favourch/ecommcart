<?php

namespace App;

use Auth;
use App\Scopes\RoleScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    const SUPER_ADMIN   = 1; //Dont change it
    const ADMIN         = 2; //Dont change it
    const MERCHANT      = 3; //Dont change it

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

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
    protected $fillable = ['name', 'shop_id', 'description', 'public', 'level'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        if(Auth::guard('web')->check() && ! Auth::guard('web')->user()->isSuperAdmin() ){
            static::addGlobalScope(new RoleScope);
        }
    }

    /**
     * Get the users for the role.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the Permissions for the role.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    /**
     * Check if the role is the super user
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->id === static::SUPER_ADMIN;
    }

    /**
     * Check if the role is the super user
     *
     * @return bool
     */
    public function isLowerPrivileged($role = Null)
    {
        if (!Auth::guard('web')->user()->role->level)
            return $this->level == Null;

        if ($role)
             return $role->level == Null || $role->level > Auth::guard('web')->user()->role->level;

         return $this->level == Null || $this->level > Auth::guard('web')->user()->role->level;
    }

    /**
     * Check if the role is a special kind
     *
     * @return bool
     */
    public function isSpecial()
    {
        return $this->id <= static::MERCHANT;
    }

    /**
     * Scope a query to only include records from the users shop.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLowerPrivileged($query)
    {
        if (Auth::guard('web')->user()->isFromPlatform()){
            if (Auth::guard('web')->user()->role->level)
                return $query->whereNull('level')->orWhere('level', '>', Auth::guard('web')->user()->role->level);

            return $query->whereNull('level');
        }

        if (Auth::guard('web')->user()->role->level)
            return $query->where('shop_id', Auth::guard('web')->user()->merchantId())->whereNull('level')->orWhere('level', '>', Auth::guard('web')->user()->role->level);

        return $query->where('shop_id', Auth::guard('web')->user()->merchantId())->whereNull('level');
    }

    /**
     * Scope a query to only include public roles.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublic($query)
    {
        return $query->where('public', 1)->whereNull('shop_id');
    }

    /**
     * Scope a query to only include non public roles.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotPublic($query)
    {
        return $query->where('public', '!=', 1);
    }

    /**
     * Scope a query to only include records from the users shop.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMine($query)
    {
        return $query->where('shop_id', Auth::guard('web')->user()->merchantId());
    }
}
