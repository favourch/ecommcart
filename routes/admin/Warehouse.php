<?php
	// warehouses
	Route::delete('warehouse/{warehouse}/trash', 'WarehouseController@trash')->name('warehouse.trash'); // warehouse move to trash 
	
	Route::get('warehouse/{warehouse}/restore', 'WarehouseController@restore')->name('warehouse.restore');

	Route::resource('warehouse', 'WarehouseController');
