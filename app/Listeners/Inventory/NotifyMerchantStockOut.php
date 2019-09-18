<?php

namespace App\Listeners\Inventory;

use App\Events\Inventory\StockOut;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyMerchantStockOut
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
     * @param  StockOut  $event
     * @return void
     */
    public function handle(StockOut $event)
    {
        //
    }
}
