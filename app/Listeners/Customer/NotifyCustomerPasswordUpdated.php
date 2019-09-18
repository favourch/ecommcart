<?php

namespace App\Listeners\Customer;

use App\Events\Customer\PasswordUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Customer\PasswordUpdated as PasswordUpdateNotification;

class NotifyCustomerPasswordUpdated implements ShouldQueue
{
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 20;

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
     * @param  PasswordUpdated  $event
     * @return void
     */
    public function handle(PasswordUpdated $event)
    {
        $event->customer->notify(new PasswordUpdateNotification($event->customer));
    }
}
