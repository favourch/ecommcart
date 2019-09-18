<?php
	Route::resource('merchant', 'MerchantController', ['except' => ['delete']]);