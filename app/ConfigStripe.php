<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigStripe extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'config_stripes';

    /**
     * The database primary key used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'shop_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                        'shop_id',
                        'stripe_user_id',
                        'publishable_key',
                        'refresh_token',
					];

    /**
     * Return Stripe client id from config
     */
    // public static function getClientId()
    // {
    //     return config('services.stripe.client_id');
    // }
}
