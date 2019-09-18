<?php

namespace App\Events\Shop;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class ShopDeleted
{
    use Dispatchable, SerializesModels;

    public $merchant_id;

    /**
     * Create a new job instance.
     *
     * @param  str  $merchant_id
     * @return void
     */
    public function __construct($merchant_id)
    {
        $this->merchant_id = $merchant_id;
    }
}
