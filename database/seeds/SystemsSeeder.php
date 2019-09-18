<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SystemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('systems')->insert([
            // 'maintenance_mode' => 1,
            'install_verion' => \App\System::VERSION,
            'name' => 'zCart',
            'legal_name' => 'Zcart Inc.',
            'email' => 'notify@demo.com',
            // 'description' => 'Etc marketplace.',
            'support_email' => 'support@demo.com',
            'is_multi_vendor' => 1,
            // 'date_format' => 'YYYY-MM-DD',
            // 'date_separator' => '-',
            // 'time_format' => '12h',
            // 'time_separator' => ':',
            'timezone_id' => '35',
            'currency_id' => 148,
            'length_unit' => 'cm',
            'weight_unit' => 'gm',
            'valume_unit' => 'liter',
            // 'currency_format' => 'x,xxx.xx',
            'show_currency_symbol' => 1,
            'show_space_after_symbol' => 0,
            'google_analytic_report' => 0,

            // Temoporary for dev
            'required_card_upfront' => Null,
            'trial_days' => 13,

            // Vendot Defults
            // 'merchant_can_create_category_group' => null,
            // 'merchant_can_create_category_sub_group' => null,
            // 'merchant_can_create_category' => null,
            // 'merchant_can_create_attribute' => null,
            // 'merchant_can_create_attribute_value' => 1,
            // 'merchant_can_create_manufacturer' => 1,
            // 'merchant_can_create_product' => 1,
            // 'merchant_can_have_own_user_roles' => 1,
            // 'merchant_can_have_own_carriers' => 1,
            // 'merchant_can_have_own_gift_cards' => 1,

            // Social media
            'facebook_link' => 'https://www.facebook.com/',
            'twitter_link' => 'https://twitter.com/',
            'google_plus_link' => 'https://plus.google.com/',
            'pinterest_link' => 'https://www.pinterest.com/',
            'instagram_link' => 'https://www.instagram.com/',
            'youtube_link' => 'https://www.youtube.com/',

            // Address Defults
            'address_show_map' => 1,
            'address_default_country' => 840, //Country id
            'address_default_state' => 1221, //State id
            'address_show_country' => 1,

            'created_at' => Carbon::Now(),
            'updated_at' => Carbon::Now(),
        ]);

        DB::table('addresses')->insert([
            'address_type' => 'Primary',
            'address_line_1' => 'Platform Address',
            'state_id' => 806,
            'zip_code' => 63585,
            'country_id' => 604,
            'city' => 'Hollywood',
            'addressable_id' => 1,
            'addressable_type' => 'App\System',
            'created_at' => Carbon::Now(),
            'updated_at' => Carbon::Now(),
        ]);
    }
}
