<?php
	// Manufacturers
	Route::delete('manufacturer/{manufacturer}/trash', 'ManufacturerController@trash')->name('manufacturer.trash'); // manufacturer move to trash

	Route::get('manufacturer/{manufacturer}/restore', 'ManufacturerController@restore')->name('manufacturer.restore');

	Route::resource('manufacturer', 'ManufacturerController');