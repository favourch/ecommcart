<?php
	// packagings
	Route::delete('packaging/{packaging}/trash', 'PackagingController@trash')->name('packaging.trash'); // packaging move to trash
	Route::get('packaging/{packaging}/restore', 'PackagingController@restore')->name('packaging.restore');
	Route::resource('packaging', 'PackagingController', ['except' =>['show']]);
