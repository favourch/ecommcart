<?php
// To view img no need to login
Route::get('image/{path}', 'ImageController@show')->where('path', '.*')->name('image.show');

Route::group(['middleware' => ['ajax']], function(){
	// Use php helper functions from js
	Route::get('helper/getFromPHPHelper', 'Admin\AjaxController@ajaxGetFromPHPHelper')->name('helper.getFromPHPHelper');

	Route::get('cart/ajax/getTaxRate', 'Admin\ShippingZoneController@ajaxGetTaxRate')->name('ajax.getTaxRate');
});

Route::group(['middleware' => ['auth']], function(){
	include('common/Image.php');
	include('common/Attachment.php');
	include('common/Address.php');
	include('common/Search.php');
});
