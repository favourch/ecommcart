<?php

namespace App\Listeners\Refund;

use App\Refund;
use App\Events\Refund\RefundInitiated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Refund\Declined as RefundDeclinedNotification;
use App\Notifications\Refund\Approved as RefundApprovedNotification;
use App\Notifications\Refund\Initiated as RefundInitiatedNotification;

class NotifyCustomerRefundInitiated implements ShouldQueue
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
     * @param  RefundInitiated  $event
     * @return void
     */
    public function handle(RefundInitiated $event)
    {
        if ($event->notify_customer){
            if(!config('system_settings'))
                setSystemConfig($event->refund->shop_id);

            if($event->refund->status == Refund::STATUS_APPROVED)
                $event->refund->customer->notify(new RefundApprovedNotification($event->refund));
            else if($event->refund->status == Refund::STATUS_DECLINED)
                $event->refund->customer->notify(new RefundDeclinedNotification($event->refund));
            else
                $event->refund->customer->notify(new RefundInitiatedNotification($event->refund));
        }
    }
}
