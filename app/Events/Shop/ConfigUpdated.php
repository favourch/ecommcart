<?php

namespace App\Events\Shop;

use App\Shop;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class ConfigUpdated
{
    use Dispatchable, SerializesModels;

    public $shop;
    public $user;
    /**
     * Create a new job instance.
     *
     * @param  Shop  $shop
     * @return void
     */
    public function __construct(Shop $shop, User $user)
    {
        $this->shop = $shop;
        $this->user = $user;
    }
}
