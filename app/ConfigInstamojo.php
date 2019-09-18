<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigInstamojo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'config_instamojo';

    /**
     * The database primary key used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'shop_id';

    /**
     * The attributes that should be casted to boolean types.
     *
     * @var array
     */
    protected $casts = [
        'sandbox' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                        'shop_id',
                        'api_key',
                        'auth_token',
                        'sandbox',
					];

    /**
     * Setters.
     */
    public function setApiKeyAttribute($value)
    {
        $this->attributes['api_key'] = trim($value);
    }
    public function setAuthTokenAttribute($value)
    {
        $this->attributes['auth_token'] = trim($value);
    }
    public function setSandboxAttribute($value)
    {
        $this->attributes['sandbox'] = (bool) $value;
    }
}
