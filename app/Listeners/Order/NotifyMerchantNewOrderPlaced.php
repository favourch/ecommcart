<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Order\MerchantOrderCreatedNotification as OrderCreatedNotification;

class NotifyMerchantNewOrderPlaced implements ShouldQueue
{
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        if(!config('shop_settings'))
            setShopConfig($event->order->shop_id);

        if(config('shop_settings.notify_new_order'))
            $event->order->shop->notify(new OrderCreatedNotification($event->order));
    }
}
