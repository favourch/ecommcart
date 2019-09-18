<?php
	// roles
	Route::delete('role/{role}/trash', 'RoleController@trash')->name('role.trash'); // role move to trash

	Route::get('role/{role}/restore', 'RoleController@restore')->name('role.restore');

	Route::resource('role', 'RoleController');