<?php

namespace App\Listeners\Inventory;

use App\Events\Inventory\InventoryLow;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyMerchantInventoryLow
{
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
     * @param  InventoryLow  $event
     * @return void
     */
    public function handle(InventoryLow $event)
    {
        //
    }
}
