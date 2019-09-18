<?php
	Route::get('shippingRate/{shippingZone}/create/{basedOn}', 'ShippingRateController@create')->name('shippingRate.create');

	Route::resource('shippingRate', 'ShippingRateController', ['except' => ['index', 'create', 'show']]);