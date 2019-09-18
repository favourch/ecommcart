<?php

namespace App\Events\Shop;

use App\Shop;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class DownForMaintainace
{
    use Dispatchable, SerializesModels;

    public $shop;

    /**
     * Create a new job instance.
     *
     * @param  Shop  $shop
     * @return void
     */
    public function __construct(Shop $shop)
    {
        $this->shop = $shop;
    }
}
