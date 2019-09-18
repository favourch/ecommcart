<?php

namespace App\Listeners\Message;

use App\Events\Message\MessageReplied;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Message\Replied as MessageRepliedNotification;

class NotifyAssociatedUsersMessagetReplied implements ShouldQueue
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
     * @param  MessageReplied  $event
     * @return void
     */
    public function handle(MessageReplied $event)
    {
        if(!config('system_settings'))
            setSystemConfig(optional($event->reply->user)->shop_id);

        if ($event->reply->user_id) {
           $event->reply->repliable->customer->notify(new MessageRepliedNotification($event->reply, $event->reply->repliable->customer->getName()));
        }
        else {
            $event->reply->repliable->user->notify(new MessageRepliedNotification($event->reply, $event->reply->repliable->user->getName()));
        }
    }
}
