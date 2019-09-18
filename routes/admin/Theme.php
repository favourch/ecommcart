<?php
	// Theme
	Route::get('/theme', 'ThemeController@all')->name('theme.index');
	Route::put('/theme/activate/{theme}/{type?}', 'ThemeController@activate')->name('theme.activate');

	// Theme Options
	Route::get('/theme/option', 'ThemeOptionController@index')->name('theme.option');
	Route::get('/theme/featuredCategories', 'ThemeOptionController@featuredCategories')->name('featuredCategories');
	Route::put('/theme/update/featuredCategories', 'ThemeOptionController@updateFeaturedCategories')->name('update.featuredCategories');
