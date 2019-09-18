<?php

namespace App\Observers;

use App\Order;
use App\Refund;

class RefundObserver
{
    /**
     * Listen to the refund saved event. This will trigger when create and update
     *
     * @param  \App\refund  $refund
     * @return void
     */
    public function saved(Refund $refund)
    {
        $order = Order::find($refund->order_id);
        $refunded_amt = $order->refundedSum();

        switch ($refund->status) {
            case Refund::STATUS_NEW:
                $payment_status = Order::PAYMENT_STATUS_INITIATED_REFUND;
                break;
            case Refund::STATUS_APPROVED:
                if ($refunded_amt < $order->total)
                    $payment_status = Order::PAYMENT_STATUS_PARTIALLY_REFUNDED;
                else
                    $payment_status = Order::PAYMENT_STATUS_REFUNDED;
                break;
            case Refund::STATUS_DECLINED:
                if (($refunded_amt > 0) && ($refunded_amt < $order->total))
                    $payment_status = Order::PAYMENT_STATUS_PARTIALLY_REFUNDED;
                else
                    $payment_status = Order::PAYMENT_STATUS_PAID;
                break;
            default:
                $payment_status = $order->payment_status;
                break;
        }

        $order->payment_status = $payment_status;
        $order->save();
    }
}