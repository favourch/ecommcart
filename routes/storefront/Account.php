<?php
	Route::get('my/{tab?}', 'AccountController@index')->name('account');
	Route::get('wishlist/{item}', 'WishlistController@add')->name('wishlist.add');
	Route::delete('wishlist/{wishlist}', 'WishlistController@remove')->name('wishlist.remove');

	Route::put('my/password/update', 'AccountController@password_update')->name('my.password.update');
	Route::put('my/account/update', 'AccountController@update')->name('account.update');
	Route::post('my/address/save', 'AccountController@save_address')->name('my.address.save');

	// Avatar
	Route::post('my/avatar/save', 'AccountController@avatar')->name('my.avatar.save');
	Route::delete('my/avatar/remove', 'AccountController@delete_avatar')->name('my.avatar.remove');

	// Address
	Route::put('my/address/{address}/update', 'AccountController@address_update')->name('my.address.update');
	Route::get('my/address/{address}/delete', 'AccountController@address_delete')->name('my.address.delete');
