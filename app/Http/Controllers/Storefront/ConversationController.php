<?php

namespace App\Http\Controllers\Storefront;

use Auth;
use App\Order;
use App\Reply;
use App\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\OrderConversationRequest;

class ConversationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     *
     * @return \Illuminate\Http\Response
     */
    public function contact(OrderConversationRequest $request, Order $order)
    {
        $user_id = Auth::user()->id;

        if($order->conversation){
            $msg = new Reply;
            $msg->reply = $request->input('message');
            if(Auth::guard('customer')->check())
                $msg->customer_id = $user_id;
            else
                $msg->user_id = $user_id;

            $order->conversation->replies()->save($msg);
        }
        else{
            $msg = new Message;
            $msg->message = $request->input('message');
            $msg->shop_id = $order->shop_id;
            if(Auth::guard('customer')->check()){
                $msg->subject = trans('theme.defaults.new_message_from', ['sender' => Auth::user()->getName()]);
                $msg->customer_id = $user_id;
            }
            else{
                $msg->user_id = $user_id;
            }

            $order->conversation()->save($msg);
        }

        // Update the order if goods_received
        if($request->has('goods_received'))
            $order->goods_received();

        if ($request->hasFile('photo'))
            $msg->saveAttachments($request->file('photo'));

        return back()->with('success', trans('theme.notify.message_sent'));
    }

}
