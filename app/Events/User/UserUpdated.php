<?php

namespace App\Events\User;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class UserUpdated
{
    use Dispatchable, SerializesModels;

    public $user;

    /**
     * Create a new job instance.
     *
     * @param  user  $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
