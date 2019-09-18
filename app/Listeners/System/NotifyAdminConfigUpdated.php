<?php

namespace App\Listeners\System;

use App\Events\System\SystemConfigUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\System\SystemConfigUpdated as SystemConfigUpdatedNotification;

class NotifyAdminConfigUpdated implements ShouldQueue
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
     * @param  SystemConfigUpdated  $event
     * @return void
     */
    public function handle(SystemConfigUpdated $event)
    {
        $event->system->superAdmin()->notify(new SystemConfigUpdatedNotification($event->system));
    }
}
