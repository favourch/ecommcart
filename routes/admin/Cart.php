<?php
	Route::delete('cart/{cart}/trash', 'CartController@trash')->name('cart.trash'); // cart move to trash 

	Route::get('cart/{cart}/restore', 'CartController@restore')->name('cart.restore');

	Route::resource('cart', 'CartController',['except'=>['create','edit']]);
