<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigPaystack extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'config_paystacks';

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
                        'merchant_email',
                        'public_key',
                        'secret',
                        'sandbox',
					];

    /**
     * Setters.
     */
    public function setMerchantEmailAttribute($value)
    {
        $this->attributes['merchant_email'] = trim($value);
    }
    public function setPublicKeyAttribute($value)
    {
        $this->attributes['public_key'] = trim($value);
    }
    public function setSecretAttribute($value)
    {
        $this->attributes['secret'] = trim($value);
    }
    public function setSandboxAttribute($value)
    {
        $this->attributes['sandbox'] = (bool) $value;
    }
}
