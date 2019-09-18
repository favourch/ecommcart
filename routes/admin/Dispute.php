<?php
	// Support Disputes
    Route::get('dispute/{dispute}/response', 'DisputeController@response')->name('dispute.response');

    Route::post('dispute/{dispute}/storeResponse', 'DisputeController@storeResponse')->name('dispute.storeResponse');

	Route::resource('dispute', 'DisputeController', ['except' => ['create', 'store','edit', 'update', 'destroy']]);