<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderFulfilled;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Order\OrderFulfilled as OrderFulfilledNotification;

class OrderBeenFulfilled implements ShouldQueue
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
     * @param  OrderFulfilled  $event
     * @return void
     */
    public function handle(OrderFulfilled $event)
    {
        if ($event->notify_customer){
            if(!config('system_settings'))
                setSystemConfig($event->order->shop_id);

            if ($event->order->customer_id)
                $event->order->customer->notify(new OrderFulfilledNotification($event->order));
        }
    }
}
