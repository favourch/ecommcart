<?php

namespace App\Listeners\Dispute;

use App\Events\Dispute\DisputeCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Dispute\SendAcknowledgement as AcknowledgementNotification;

class SendAcknowledgementNotification implements ShouldQueue
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
     * @param  DisputeCreated  $event
     * @return void
     */
    public function handle(DisputeCreated $event)
    {
        $event->dispute->customer->notify(new AcknowledgementNotification($event->dispute));
    }
}
