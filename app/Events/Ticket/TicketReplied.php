<?php

namespace App\Events\Ticket;

use App\Reply;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class TicketReplied
{
    use Dispatchable, SerializesModels;

    public $reply;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }
}
