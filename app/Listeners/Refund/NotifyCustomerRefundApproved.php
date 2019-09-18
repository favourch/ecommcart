<?php

namespace App\Listeners\Refund;

use App\Events\Refund\RefundApproved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Refund\Approved as RefundApprovedNotification;

class NotifyCustomerRefundApproved implements ShouldQueue
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
     * @param  RefundApproved  $event
     * @return void
     */
    public function handle(RefundApproved $event)
    {
        if(!config('system_settings'))
            setSystemConfig($event->refund->shop_id);

        $event->refund->customer->notify(new RefundApprovedNotification($event->refund));
    }
}
