<?php

namespace App\Events\Dispute;

use App\Dispute;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class DisputeCreated
{
    use Dispatchable, SerializesModels;

    public $dispute;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Dispute $dispute)
    {
        $this->dispute = $dispute;
    }
}
