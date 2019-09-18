<?php

namespace App\Events\Inventory;

use App\Inventory;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class InventoryLow
{
    use Dispatchable, SerializesModels;

    public $inventory;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Inventory $inventory)
    {
        $this->inventory = $inventory;
    }
}
