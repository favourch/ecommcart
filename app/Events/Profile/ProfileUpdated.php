<?php

namespace App\Events\Profile;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class ProfileUpdated
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
