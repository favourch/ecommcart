<?php
	// carriers
	Route::delete('carrier/{carrier}/trash', 'CarrierController@trash')->name('carrier.trash'); // carrier move to trash 
	
	Route::get('carrier/{carrier}/restore', 'CarrierController@restore')->name('carrier.restore');

	Route::resource('carrier', 'CarrierController');
