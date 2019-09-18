<?php
	// Admin User Auth
	Route::auth();
   	Route::get('/register/{plan?}', 'Auth\RegisterController@showRegistrationForm')->name('register');
	Route::get('/verify/{token?}', 'Auth\RegisterController@verify')->name('verify');
	Route::get('/logout' , 'Auth\LoginController@logout');
