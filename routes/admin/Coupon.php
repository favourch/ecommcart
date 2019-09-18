<?php
	// coupons
	Route::delete('coupon/{coupon}/trash', 'CouponController@trash')->name('coupon.trash'); // coupon move to trash

	Route::get('coupon/{coupon}/restore', 'CouponController@restore')->name('coupon.restore');

	Route::resource('coupon', 'CouponController');
