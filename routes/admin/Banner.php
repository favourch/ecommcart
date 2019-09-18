<?php
	// Banner
	Route::resource('banner', 'BannerController', ['except' => ['show']]);