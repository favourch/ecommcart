<?php
	Route::post('order/{cart}', 'OrderController@create')->name('order.create');
	Route::get('paymentFailed/{order}', 'OrderController@paymentFailed')->name('payment.failed');

	// PayPal
	Route::get('paymentSuccess/{order}', 'OrderController@paymentSuccess')->name('payment.success');
	Route::get('order/{order}/success', 'OrderController@orderPlaced')->name('order.success');

	// Paystack
	Route::get('instamojoRedirect/{order}/{cart}', 'OrderController@instamojoSuccess')->name('instamojo.redirect');;

	// Paystack
	Route::get('paystackSuccess/{order}/{cart}', 'OrderController@paystackPaymentSuccess')->name('paystack.success');;

	Route::middleware(['auth:customer'])->group(function () {
		Route::get('order/{order}', 'OrderController@detail')->name('order.detail');
		Route::get('order/track/{order}', 'OrderController@track')->name('order.track');
		Route::put('order/goodsReceived/{order}', 'OrderController@goods_received')->name('goods.received');

		// Conversations
		Route::post('order/conversation/{order}', 'ConversationController@contact')->name('order.conversation');

		// Disputes
		Route::get('order/dispute/{order}', 'DisputeController@show_dispute_form')->name('dispute.open');
		Route::post('order/dispute/{order}', 'DisputeController@open_dispute')->name('dispute.save');
		Route::post('dispute/{dispute}', 'DisputeController@response')->name('dispute.response');
		Route::post('dispute/{dispute}/appeal', 'DisputeController@appeal')->name('dispute.appeal');

		// Refunds
		// Route::post('order/refund/{order}', 'DisputeController@refund_request')->name('refund.request');
	});