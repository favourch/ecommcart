<?php
	// refunds
    Route::get('refund/{refund}/response', 'RefundController@response')->name('refund.response');

    Route::get('refund/{refund}/approve', 'RefundController@approve')->name('refund.approve');

    Route::get('refund/{refund}/decline', 'RefundController@decline')->name('refund.decline');

    Route::get('refund/initiate/{order?}', 'RefundController@showRefundForm')->name('refund.form');

    Route::post('refund/initiate', 'RefundController@initiate')->name('refund.initiate');

    Route::get('refund', 'RefundController@index')->name('refund.index');