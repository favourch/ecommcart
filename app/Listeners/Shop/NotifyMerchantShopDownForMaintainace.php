<?php

namespace App\Listeners\Shop;

use App\Events\Shop\DownForMaintainace;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Shop\ShopDownForMaintainace;

class NotifyMerchantShopDownForMaintainace implements ShouldQueue
{
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

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
     * @param  DownForMaintainace  $event
     * @return void
     */
    public function handle(DownForMaintainace $event)
    {
        $event->shop->owner->notify(new ShopDownForMaintainace($event->shop));
    }
}
