<?php
	// Bulk upload routes
	// Route::get('inventory/upload/downloadCategorySlugs', 'InventoryUploadController@downloadCategorySlugs')->name('inventory.downloadCategorySlugs');
	// Route::get('inventory/upload/downloadTemplate', 'InventoryUploadController@downloadTemplate')->name('inventory.downloadTemplate');
	Route::get('inventory/upload', 'InventoryUploadController@showForm')->name('inventory.bulk');
	// Route::post('inventory/upload', 'InventoryUploadController@upload')->name('inventory.upload');
	// Route::post('inventory/import', 'InventoryUploadController@import')->name('inventory.import');
	// Route::post('inventory/downloadFailedRows', 'InventoryUploadController@downloadFailedRows')->name('inventory.downloadFailedRows');

	// inventorys
	Route::delete('inventory/{inventory}/trash', 'InventoryController@trash')->name('inventory.trash'); // inventory move to trash
	Route::get('inventory/{inventory}/restore', 'InventoryController@restore')->name('inventory.restore');
	// Route::get('inventory/showSearchForm', 'InventoryController@showSearchForm')->name('inventory.showSearchForm');
	// Route::get('inventory/search', 'InventoryController@search')->name('inventory.search');
	Route::get('inventory/setVariant/{inventory}', 'InventoryController@setVariant')->name('inventory.setVariant');
	Route::get('inventory/add/{inventory}', 'InventoryController@add')->name('inventory.add');
	Route::get('inventory/addWithVariant/{inventory}', 'InventoryController@addWithVariant')->name('inventory.addWithVariant');
	Route::post('inventory/storeWithVariant', 'InventoryController@storeWithVariant')->name('inventory.storeWithVariant');
	Route::post('inventory/store', 'InventoryController@store')->name('inventory.store')->middleware('ajax');
	Route::post('inventory/{inventory}/update', 'InventoryController@update')->name('inventory.update')->middleware('ajax');
	Route::get('inventory/{inventory}/editQtt', 'InventoryController@editQtt')->name('inventory.editQtt');
	Route::put('inventory/{inventory}/updateQtt', 'InventoryController@updateQtt')->name('inventory.updateQtt');
	Route::resource('inventory', 'InventoryController', ['except' =>['create', 'store', 'update']]);