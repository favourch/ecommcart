<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

        // Blog Events
        // 'App\Events\Blog\BlogPublished' => [
        //     'App\Listeners\Blog\EmailToSubscribers',
        // ],
        // 'App\Events\Blog\UserRepliedToConversation' => [
        //     'App\Listeners\Blog\EmailConversationSubscribers',
        // ],

        // Announcement Events
        'App\Events\Announcement\AnnouncementCreated' => [
            'App\Listeners\Announcement\SendAnnouncementCreatedNotification',
        ],

        // Customer Events
        'App\Events\Customer\Registered' => [
            'App\Listeners\Customer\SendWelcomeEmail',
        ],
        'App\Events\Customer\CustomerCreated' => [
            'App\Listeners\Customer\SendLoginInfo',
        ],
        'App\Events\Customer\CustomerUpdated' => [
            'App\Listeners\Customer\SendProfileUpdateNotification',
        ],
        'App\Events\Customer\PasswordUpdated' => [
            'App\Listeners\Customer\NotifyCustomerPasswordUpdated',
        ],

        // Dispute Events
        'App\Events\Dispute\DisputeCreated' => [
            'App\Listeners\Dispute\SendAcknowledgementNotification',
            'App\Listeners\Dispute\NotifyMerchantDisputeCreated',
        ],
        'App\Events\Dispute\DisputeUpdated' => [
            'App\Listeners\Dispute\NotifyCustomerDisputeUpdated',
        ],

        // Inventory Events
        // Neet to complete
        'App\Events\Inventory\InventoryLow' => [
            'App\Listeners\Inventory\NotifyMerchantInventoryLow',
        ],
        // Neet to complete
        'App\Events\Inventory\StockOut' => [
            'App\Listeners\Inventory\NotifyMerchantStockOut',
        ],

        // Message Events
        'App\Events\Message\NewMessage' => [
            'App\Listeners\Message\SendNewMessageNotificationToReceiver',
        ],
        'App\Events\Message\MessageReplied' => [
            'App\Listeners\Message\NotifyAssociatedUsersMessagetReplied',
        ],

        // Order Events
        'App\Events\Order\OrderCreated' => [
            'App\Listeners\Order\NotifyCustomerOrderPlaced',
            'App\Listeners\Order\NotifyMerchantNewOrderPlaced',
            'App\Listeners\Order\LowInventoryCheck',
        ],
        'App\Events\Order\OrderUpdated' => [
            'App\Listeners\Order\NotifyCustomerOrderUpdated',
        ],
        'App\Events\Order\OrderFulfilled' => [
            'App\Listeners\Order\OrderBeenFulfilled',
        ],
        'App\Events\Order\OrderPaid' => [
            'App\Listeners\Order\OrderBeenPaid',
        ],
        'App\Events\Order\OrderPaymentFailed' => [
            'App\Listeners\Order\NotifyCustomerPaymentFailed',
        ],

        // Profile Events
        'App\Events\Profile\ProfileUpdated' => [
            'App\Listeners\Profile\NotifyUserProfileUpdated',
        ],
        'App\Events\Profile\PasswordUpdated' => [
            'App\Listeners\Profile\NotifyUserPasswordUpdated',
        ],

        // Refund Events
        'App\Events\Refund\RefundInitiated' => [
            'App\Listeners\Refund\NotifyCustomerRefundInitiated',
        ],
        'App\Events\Refund\RefundApproved' => [
            'App\Listeners\Refund\NotifyCustomerRefundApproved',
        ],
        'App\Events\Refund\RefundDeclined' => [
            'App\Listeners\Refund\NotifyCustomerRefundDeclined',
        ],

        // Shop Events
        'App\Events\Shop\ShopCreated' => [
            'App\Listeners\Shop\NotifyMerchantShopCreated',
        ],
        'App\Events\Shop\ShopUpdated' => [
            'App\Listeners\Shop\NotifyMerchantShopUpdated',
        ],
        'App\Events\Shop\ConfigUpdated' => [
            'App\Listeners\Shop\NotifyMerchantConfigUpdated',
        ],
        'App\Events\Shop\ShopDeleted' => [
            'App\Listeners\Shop\NotifyMerchantShopDeleted',
        ],
        'App\Events\Shop\DownForMaintainace' => [
            'App\Listeners\Shop\NotifyMerchantShopDownForMaintainace',
        ],
        'App\Events\Shop\ShopIsLive' => [
            'App\Listeners\Shop\NotifyMerchantShopIsLive',
        ],

        // Subscription Events
        'App\Events\Subscription\UserSubscribed' => [
            'App\Listeners\Subscription\UpdateActiveSubscription',
            'App\Listeners\Subscription\UpdateTrialEndingDate',
        ],
        'App\Events\Subscription\SubscriptionUpdated' => [
            'App\Listeners\Subscription\UpdateActiveSubscription',
        ],
        'App\Events\Subscription\SubscriptionCancelled' => [
            'App\Listeners\Subscription\UpdateActiveSubscription',
        ],


        // System Events
        'App\Events\System\SystemInfoUpdated' => [
            'App\Listeners\System\NotifyAdminSystemUpdated',
        ],
        'App\Events\System\SystemConfigUpdated' => [
            'App\Listeners\System\NotifyAdminConfigUpdated',
        ],
        'App\Events\System\DownForMaintainace' => [
            'App\Listeners\System\NotifyAdminSystemIsDown',
        ],
        'App\Events\System\SystemIsLive' => [
            'App\Listeners\System\NotifyAdminSystemIsLive',
        ],

        // Ticket Events
        'App\Events\Ticket\TicketCreated' => [
            'App\Listeners\Ticket\SendAcknowledgementNotification',
        ],
        'App\Events\Ticket\TicketAssigned' => [
            'App\Listeners\Ticket\NotifyUserTicketAssigned',
        ],
        'App\Events\Ticket\TicketReplied' => [
            'App\Listeners\Ticket\NotifyAssociatedUsersTicketReplied',
        ],
        'App\Events\Ticket\TicketUpdated' => [
            'App\Listeners\Ticket\NotifyUserTicketUpdated',
        ],

        // User Events
        'Illuminate\Auth\Events\Registered' => [
            'App\Listeners\User\SendVerificationEmail',
            // 'Illuminate\Auth\Listeners\SendEmailVerificationNotification',
        ],
        'App\Events\User\UserCreated' => [
            'App\Listeners\User\SendLoginInfo',
        ],
        'App\Events\User\UserUpdated' => [
            'App\Listeners\User\NotifyUserProfileUpdated',
        ],
        'Illuminate\Auth\Events\PasswordReset' => [
            'App\Listeners\User\NotifyUserPasswordUpdated',
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
