<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Order\OrderUpdated as OrderUpdatedNotification;

class NotifyCustomerOrderUpdated implements ShouldQueue
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
     * @param  OrderUpdated  $event
     * @return void
     */
    public function handle(OrderUpdated $event)
    {
        if ($event->notify_customer){
            if(!config('system_settings'))
                setSystemConfig($event->order->shop_id);

            $event->order->customer->notify(new OrderUpdatedNotification($event->order));
        }
    }
}
