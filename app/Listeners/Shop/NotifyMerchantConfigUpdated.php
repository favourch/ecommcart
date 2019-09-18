<?php

namespace App\Listeners\Shop;

use App\Events\Shop\ConfigUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Shop\ShopConfigUpdated;

class NotifyMerchantConfigUpdated implements ShouldQueue
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
     * @param  ConfigUpdated  $event
     * @return void
     */
    public function handle(ConfigUpdated $event)
    {
        $event->shop->owner->notify(new ShopConfigUpdated($event->shop, $event->user));
    }
}
