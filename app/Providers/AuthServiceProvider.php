<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Attribute::class           => \App\Policies\AttributePolicy::class,
        \App\AttributeValue::class      => \App\Policies\AttributeValuePolicy::class,
        \App\Banner::class              => \App\Policies\BannerPolicy::class,
        \App\Blog::class                => \App\Policies\BlogPolicy::class,
        \App\CarrierValue::class        => \App\Policies\CarrierValuePolicy::class,
        \App\Cart::class                => \App\Policies\CartPolicy::class,
        \App\Carrier::class              => \App\Policies\CarrierPolicy::class,
        \App\Category::class            => \App\Policies\CategoryPolicy::class,
        \App\CategoryGroup::class       => \App\Policies\CategoryGroupPolicy::class,
        \App\CategorySubGroup::class    => \App\Policies\CategorySubGroupPolicy::class,
        \App\Config::class              => \App\Policies\ConfigPolicy::class,
        \App\Coupon::class              => \App\Policies\CouponPolicy::class,
        \App\Customer::class            => \App\Policies\CustomerPolicy::class,
        \App\Currency::class            => \App\Policies\CurrencyPolicy::class,
        \App\Dispute::class             => \App\Policies\DisputePolicy::class,
        \App\EmailTemplate::class       => \App\Policies\EmailTemplatePolicy::class,
        \App\Faq::class                 => \App\Policies\FaqPolicy::class,
        \App\GiftCard::class            => \App\Policies\GiftCardPolicy::class,
        \App\Inventory::class           => \App\Policies\InventoryPolicy::class,
        \App\Manufacturer::class        => \App\Policies\ManufacturerPolicy::class,
        \App\Merchant::class            => \App\Policies\MerchantPolicy::class,
        \App\Message::class             => \App\Policies\MessagePolicy::class,
        \App\Order::class               => \App\Policies\OrderPolicy::class,
        \App\OrderStatus::class         => \App\Policies\OrderStatusPolicy::class,
        \App\OrderStatus::class         => \App\Policies\OrderStatusPolicy::class,
        \App\Packaging::class           => \App\Policies\PackagingPolicy::class,
        \App\Page::class                => \App\Policies\PagePolicy::class,
        \App\Permission::class          => \App\Policies\PermissionPolicy::class,
        \App\Product::class             => \App\Policies\ProductPolicy::class,
        \App\Refund::class              => \App\Policies\RefundPolicy::class,
        \App\Role::class                => \App\Policies\RolePolicy::class,
        \App\Shop::class                => \App\Policies\ShopPolicy::class,
        \App\ShippingRate::class        => \App\Policies\ShippingRatePolicy::class,
        \App\ShippingZone::class        => \App\Policies\ShippingZonePolicy::class,
        \App\Slider::class              => \App\Policies\SliderPolicy::class,
        \App\SubscriptionPlan::class    => \App\Policies\SubscriptionPlanPolicy::class,
        \App\Supplier::class            => \App\Policies\SupplierPolicy::class,
        \App\System::class              => \App\Policies\SystemPolicy::class,
        \App\SystemConfig::class        => \App\Policies\SystemConfigPolicy::class,
        \App\Tax::class                 => \App\Policies\TaxPolicy::class,
        \App\Ticket::class              => \App\Policies\TicketPolicy::class,
        \App\User::class                => \App\Policies\UserPolicy::class,
        \App\Warehouse::class           => \App\Policies\WarehousePolicy::class,
        \App\Wishlist::class            => \App\Policies\WishlistPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        // Gate::resource('blog', 'BlogPolicy');

        // Gate::resource('posts', 'PostPolicy', [
        //     'restore' => 'restore',
        //     'destroy' => 'destroy',
        // ]);
    }
}
