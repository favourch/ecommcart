<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderPaid;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Order\OrderBeenPaid as OrderBeenPaidNotification;

class OrderBeenPaid implements ShouldQueue
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
     * @param  OrderPaid  $event
     * @return void
     */
    public function handle(OrderPaid $event)
    {
        if(!config('system_settings'))
            setSystemConfig($event->order->shop_id);

        if ($event->order->customer->id)
            $event->order->customer->notify(new OrderBeenPaidNotification($event->order));
    }
}
