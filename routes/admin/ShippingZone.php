<?php
	Route::delete('shippingZone/{shippingZone}/removeCountry/{country}', 'ShippingZoneController@removeCountry')->name('shippingZone.removeCountry');

	Route::get('shippingZone/{shippingZone}/editStates/{country}', 'ShippingZoneController@editStates')->name('shippingZone.editStates');

	Route::put('shippingZone/{shippingZone}/updateStates/{country}', 'ShippingZoneController@updateStates')->name('shippingZone.updateStates');

	Route::resource('shippingZone', 'ShippingZoneController', ['except' => 'show']);