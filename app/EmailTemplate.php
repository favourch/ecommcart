<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailTemplate extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'email_templates';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'deleted_at'];

    /**
     * Get the shop associated with the cart.
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    /**
     * Scope a query to only include records from the users shop.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMine($query)
    {
        return $query->where('shop_id', Auth::user()->merchantId());
    }

    /**
     * Get the emaitemplate body with replaced short codes.
     *
     * @return string
     */
    public function getBodyAttribute($question)
    {
        // Platform planceholders
        $question = str_replace(
                [
                    '{PLATFORM_NAME}',
                    '{PLATFORM_URL}',
                    '{PLATFORM_ADDRESS}',
                    '{SUPPORT_EMAIL}',
                    '{SUPPORT_PHONE}'
                ], [
                    get_platform_title(),
                    '<a href="' . url('/') . '" target="_black">' . url('/') . '</a>',
                    get_platform_address(),
                    config('system_settings.support_email'),
                    config('system_settings.support_phone'),
                ],
                $question);

        // Merchant planceholders
        $question = str_replace(
                [
                    '{SHOP_NAME}',
                    '{SHOP_URL}',
                    '{SHOP_SUPPORT_EMAIL}',
                    '{SHOP_SUPPORT_PHONE}'
                ], [
                    config('shop_settings.name'),
                    '<a href="' . get_shop_url() . '" target="_black">' . get_shop_url() . '</a>',
                    config('shop_settings.support_email'),
                    config('shop_settings.support_phone'),
                ],
                $question);

        // Pages planceholders
        $question = str_replace(
                [
                    '{CONTACT_US}',
                    '{ABOUT_US}',
                    '{PRIVACY_POLICY}',
                    '{TERMS_AND_CONDITIONS_FOR_CUSTOMER}',
                    '{TERMS_AND_CONDITIONS_FOR_MERCHANT}',
                    '{RETURN_AND_REFUND}'
                ], [
                    get_page_url(\App\Page::PAGE_CONTACT_US),
                    get_page_url(\App\Page::PAGE_ABOUT_US),
                    get_page_url(\App\Page::PAGE_PRIVACY_POLICY),
                    get_page_url(\App\Page::PAGE_TNC_FOR_CUSTOMER),
                    get_page_url(\App\Page::PAGE_TNC_FOR_MERCHANT),
                    get_page_url(\App\Page::PAGE_RETURN_AND_REFUND)
                ],
                $question);

        return $question;
    }
}