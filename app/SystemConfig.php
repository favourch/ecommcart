<?php

namespace App;

use App\Common\SystemUsers;
use Illuminate\Database\Eloquent\Model;

class SystemConfig extends Model
{
    use SystemUsers;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'systems';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                        'trial_days',
                        'required_card_upfront',
                        'support_phone',
                        'support_phone_toll_free',
                        'support_email',
                        'default_sender_email_address',
                        'default_email_sender_name',
                        'length_unit',
                        'weight_unit',
                        'valume_unit',
                        // 'date_format',
                        // 'date_separator',
                        // 'time_format',
                        // 'time_separator',
                        'decimals',
                        'decimalpoint',
                        'thousands_separator',
                        'show_currency_symbol',
                        'show_space_after_symbol',
                        'coupon_code_size',
                        'gift_card_serial_number_size',
                        'gift_card_pin_size',
                        'max_img_size_limit_kb',
                        'max_number_of_inventory_imgs',
                        'active_theme',
                        'pagination',
                        'show_address_title',
                        'address_show_country',
                        'address_show_map',
                        'address_default_country',
                        'address_default_state',
                        'allow_guest_checkout',
                        'auto_approve_order',
                        'ask_customer_for_email_subscription',
                        'vendor_can_view_customer_info',
                        'notify_when_vendor_registered',
                        'notify_when_dispute_appealed',
                        'notify_new_message',
                        'notify_new_ticket',
                        'facebook_link',
                        'google_plus_link',
                        'twitter_link',
                        'pinterest_link',
                        'youtube_link',
                        'google_analytic_report',
                    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
                'required_card_upfront' => 'boolean',
                'allow_guest_checkout' => 'boolean',
                'auto_approve_order' => 'boolean',
                'vendor_can_view_customer_info' => 'boolean',
                'ask_customer_for_email_subscription' => 'boolean',
                'notify_when_vendor_registered' => 'boolean',
                'notify_when_dispute_appealed' => 'boolean',
                'notify_new_message' => 'boolean',
                'notify_new_ticket' => 'boolean',
                'show_currency_symbol' => 'boolean',
                'show_space_after_symbol' => 'boolean',
                'show_address_title' => 'boolean',
                'address_show_country' => 'boolean',
                'address_show_map' => 'boolean',
                'google_analytic_report' => 'boolean',
            ];

    /**
     * Check if Ggoogle Analytic has been Configured.
     *
     * @return bool
     */
    public static function isGgoogleAnalyticConfigured()
    {
        return (bool) config('analytics.view_id');
    }
}
