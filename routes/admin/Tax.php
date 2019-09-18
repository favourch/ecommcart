<?php
	// taxes
	Route::delete('tax/{tax}/trash', 'TaxController@trash')->name('tax.trash'); // tax move to trash 
	
	Route::get('tax/{tax}/restore', 'TaxController@restore')->name('tax.restore');

	Route::resource('tax', 'TaxController',['except' => 'show']);
