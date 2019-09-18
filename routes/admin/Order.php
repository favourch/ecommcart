<?php
	Route::delete('order/{order}/archive', 'OrderController@archive')->name('order.archive'); // order move to trash

	Route::get('order/{order}/restore', 'OrderController@restore')->name('order.restore');

	Route::get('order/searchCutomer', 'OrderController@searchCutomer')->name('order.searchCutomer');

	Route::get('order/{order}/fulfill', 'OrderController@fulfillment')->name('order.fulfillment');

	Route::put('order/{order}/fulfill', 'OrderController@fulfill')->name('order.fulfill');

	Route::put('order/{order}/updateOrderStatus', 'OrderController@updateOrderStatus')->name('order.updateOrderStatus');

	Route::put('order/{order}/togglePaymentStatus', 'OrderController@togglePaymentStatus')->name('order.togglePaymentStatus');

	Route::resource('order', 'OrderController', ['except' => ['update','destroy']]);