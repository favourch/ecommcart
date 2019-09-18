<?php
Route::get('address/ajax/getCountryStates', 'AddressController@ajaxCountryStates')->name('ajax.getCountryStates')->middleware('ajax');

Route::get('address/addresses/{addressable_type}/{addressable_id}', 'AddressController@addresses')->name('address.addresses');

Route::get('address/create/{addressable_type}/{addressable_id}', 'AddressController@create')->name('address.create');

Route::resource('address', 'AddressController', ['except' => ['index', 'create', 'show']]);