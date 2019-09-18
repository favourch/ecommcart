<?php

namespace App\Events\Message;

use App\Reply;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class MessageReplied
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
