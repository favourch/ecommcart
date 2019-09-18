<?php

namespace App\Http\Controllers\Storefront;

use Auth;
use App\Order;
use App\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\OrderDetailRequest;
use App\Http\Requests\Validations\ShopFeedbackCreateRequest;
use App\Http\Requests\Validations\ProductFeedbackCreateRequest;

class FeedbackController extends Controller
{
    /**
     * Show feedback form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Order   $order
     *
     * @return \Illuminate\Http\Response
     */
    public function feedback_form(OrderDetailRequest $request, Order $order)
    {
        $order->load(['inventories.image','inventories.product.feedbacks:id,feedbackable_id']);

        return view('feedback_form', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Order   $order
     * @return \Illuminate\Http\Response
     */
    public function save_shop_feedbacks(ShopFeedbackCreateRequest $request, Order $order)
    {
        $feedback = $order->shop->feedbacks()->create($request->all());

        $order->feedback_given($feedback->id);

        return back()->with('success', trans('theme.notify.your_feedback_saved'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Order   $order
     * @return \Illuminate\Http\Response
     */
    public function save_product_feedbacks(ProductFeedbackCreateRequest $request, Order $order)
    {
        $inputs = $request->input('items');
        $customer_id = Auth::guard('customer')->user()->id; //Set customer_id

        foreach ($order->inventories as $inventory) {
            $feedback_data = $inputs[$inventory->id];
            $feedback_data['customer_id'] = $customer_id;

            $feedback = $inventory->feedbacks()->create($feedback_data);

            // Update feedback_id in order_items table
            \DB::table('order_items')->where('order_id', $inventory->pivot->order_id)
            ->where('inventory_id', $inventory->id)->update(['feedback_id' => $feedback->id]);
        }

        return back()->with('success', trans('theme.notify.your_feedback_saved'));
    }

}
