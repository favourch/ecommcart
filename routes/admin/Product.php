<?php
	// Bulk upload routes
	Route::get('product/upload/downloadCategorySlugs', 'ProductUploadController@downloadCategorySlugs')->name('product.downloadCategorySlugs');
	Route::get('product/upload/downloadTemplate', 'ProductUploadController@downloadTemplate')->name('product.downloadTemplate');
	Route::get('product/upload', 'ProductUploadController@showForm')->name('product.bulk');
	Route::post('product/upload', 'ProductUploadController@upload')->name('product.upload');
	Route::post('product/import', 'ProductUploadController@import')->name('product.import');
	Route::post('product/downloadFailedRows', 'ProductUploadController@downloadFailedRows')->name('product.downloadFailedRows');

	// Product model routes
	Route::delete('product/{product}/trash', 'ProductController@trash')->name('product.trash'); // product move to trash
	Route::get('product/{product}/restore', 'ProductController@restore')->name('product.restore');
	Route::post('product/store', 'ProductController@store')->name('product.store')->middleware('ajax');
	Route::post('product/{product}/update', 'ProductController@update')->name('product.update')->middleware('ajax');
	Route::get('product/getProducts', 'ProductController@getProducts')->name('product.getMore');
	Route::resource('product', 'ProductController', ['except' =>['store', 'update']]);