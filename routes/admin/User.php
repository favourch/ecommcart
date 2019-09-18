<?php
	Route::delete('user/{user}/trash', 'UserController@trash')->name('user.trash');

	Route::get('user/{user}/restore', 'UserController@restore')->name('user.restore');

	Route::resource('user', 'UserController');