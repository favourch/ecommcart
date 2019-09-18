<?php

namespace App\Events\Refund;

use App\Refund;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class RefundInitiated
{
    use Dispatchable, SerializesModels;

    public $refund;
    public $notify_customer;

    /**
     * Create a new job instance.
     *
     * @param  Refund  $refund
     * @return void
     */
    public function __construct(Refund $refund, $notify_customer = Null)
    {
        $this->refund = $refund;
        $this->notify_customer = $notify_customer;
    }
}
