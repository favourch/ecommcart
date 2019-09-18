<?php
	Route::delete('orderStatus/{orderStatus}/trash', 'OrderStatusController@trash')->name('orderStatus.trash');
	Route::get('orderStatus/{orderStatus}/restore', 'OrderStatusController@restore')->name('orderStatus.restore');
	Route::resource('orderStatus', 'OrderStatusController', ['except' => ['show']]);
