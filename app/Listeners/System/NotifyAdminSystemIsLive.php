<?php

namespace App\Listeners\System;

use App\Events\System\SystemIsLive;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\System\SystemIsLive as SystemIsLiveNotification;

class NotifyAdminSystemIsLive implements ShouldQueue
{
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 10;

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
     * @param  SystemIsLive  $event
     * @return void
     */
    public function handle(SystemIsLive $event)
    {
        $event->system->superAdmin()->notify(new SystemIsLiveNotification($event->system));
    }
}
