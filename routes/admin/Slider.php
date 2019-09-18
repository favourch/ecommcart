<?php
	// slider
	Route::delete('slider/{slider}/trash', 'SliderController@trash')->name('slider.trash'); // slider post move to trash

	Route::get('slider/{slider}/restore', 'SliderController@restore')->name('slider.restore');

	Route::resource('slider', 'SliderController', ['except' => ['show']]);