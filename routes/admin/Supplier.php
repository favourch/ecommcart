<?php
	// Suppliers
	Route::delete('supplier/{supplier}/trash', 'SupplierController@trash')->name('supplier.trash'); // supplier move to trash
	Route::get('supplier/{supplier}/restore', 'SupplierController@restore')->name('supplier.restore');
	Route::resource('supplier', 'SupplierController');