<?php

namespace App\Events\Order;

use App\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class OrderUpdated
{
    use Dispatchable, SerializesModels;

    public $order;
    public $notify_customer;

    /**
     * Create a new job instance.
     *
     * @param  Order  $order
     * @return void
     */
    public function __construct(Order $order, $notify_customer = Null)
    {
        $this->order = $order;
        $this->notify_customer = $notify_customer;
    }
}