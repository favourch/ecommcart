<?php

namespace App\Listeners\Refund;

use App\Events\Refund\RefundDeclined;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Refund\Declined as RefundDeclinedNotification;

class NotifyCustomerRefundDeclined implements ShouldQueue
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
     * @param  RefundDeclined  $event
     * @return void
     */
    public function handle(RefundDeclined $event)
    {
        if(!config('system_settings'))
            setSystemConfig($event->refund->shop_id);

        $event->refund->customer->notify(new RefundDeclinedNotification($event->refund));
    }
}
