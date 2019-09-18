<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderPaymentFailed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Order\PaymentFailed as PaymentFailedNotification;

class NotifyCustomerPaymentFailed implements ShouldQueue
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
     * @param  OrderPaymentFailed  $event
     * @return void
     */
    public function handle(OrderPaymentFailed $event)
    {
        if(!config('system_settings'))
            setSystemConfig($event->order->shop_id);

        $event->order->customer->notify(new PaymentFailedNotification($event->order));
    }
}
