<?php

namespace App\Listeners\Ticket;

use App\Events\Ticket\TicketReplied;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Ticket\TicketReplied as TicketRepliedNotification;

class NotifyAssociatedUsersTicketReplied implements ShouldQueue
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
     * @param  TicketReplied  $event
     * @return void
     */
    public function handle(TicketReplied $event)
    {
        if ($event->reply->user->isFromPlatform()){

            $event->reply->repliable->user->notify(new TicketRepliedNotification($event->reply, $event->reply->repliable->user->getName()));
        }
        else if($event->reply->repliable->assignedTo){

            $event->reply->repliable->assignedTo->notify(new TicketRepliedNotification($event->reply, $event->reply->repliable->assignedTo->getName()));
        }
    }
}
