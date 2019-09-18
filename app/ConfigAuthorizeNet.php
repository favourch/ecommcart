<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigAuthorizeNet extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'config_authorize_net';

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
                        'api_login_id',
                        'transaction_key',
                        'sandbox',
					];

    /**
     * Setters.
     */
    public function setApiLoginIdAttribute($value)
    {
        $this->attributes['api_login_id'] = trim($value);
    }
    public function setTransactionKeyAttribute($value)
    {
        $this->attributes['transaction_key'] = trim($value);
    }
    public function setSandboxAttribute($value)
    {
        $this->attributes['sandbox'] = (bool) $value;
    }

}
