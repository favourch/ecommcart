<?php

namespace App\Listeners\Ticket;

use App\Events\Ticket\TicketAssigned;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Ticket\TicketAssigned as TicketAssignedNotification;

class NotifyUserTicketAssigned implements ShouldQueue
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
     * @param  TicketAssigned  $event
     * @return void
     */
    public function handle(TicketAssigned $event)
    {
        $event->ticket->assignedTo->notify(new TicketAssignedNotification($event->ticket));
    }
}
