<?php
Route::get('attributeValue/create/{attribute?}', 'AttributeValueController@create')->name('attributeValue.create');

Route::delete('attributeValue/{attributeValue}/trash', 'AttributeValueController@trash')->name('attributeValue.trash');

Route::get('attributeValue/{attributeValue}/restore', 'AttributeValueController@restore')->name('attributeValue.restore');

Route::post('attributeValue/reorder', 'AttributeValueController@reorder')->name('attributeValue.reorder');

Route::resource('attributeValue', 'AttributeValueController', ['except' => ['index', 'create']]);
