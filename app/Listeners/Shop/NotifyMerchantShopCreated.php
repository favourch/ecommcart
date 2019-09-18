<?php

namespace App\Listeners\Shop;

use App\Events\Shop\ShopCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Shop\ShopCreated as ShopCreatedNotification;

class NotifyMerchantShopCreated implements ShouldQueue
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
     * @param  ShopCreated  $event
     * @return void
     */
    public function handle(ShopCreated $event)
    {
        $event->shop->owner->notify(new ShopCreatedNotification($event->shop));
    }
}
