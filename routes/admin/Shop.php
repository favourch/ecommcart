<?php
	// Shops
	Route::get('shop/{shop}/staffs', 'ShopController@staffs')->name('shop.staffs');

	Route::delete('shop/{shop}/trash', 'ShopController@trash')->name('shop.trash'); // shop move to trash

	Route::get('shop/{shop}/restore', 'ShopController@restore')->name('shop.restore');

	Route::resource('shop', 'ShopController', ['except' => ['create', 'store']]);
