<?php
	// Blog
	Route::delete('blog/{blog}/trash', 'BlogController@trash')->name('blog.trash'); // Blog post move to trash

	Route::get('blog/{blog}/restore', 'BlogController@restore')->name('blog.restore');

	Route::resource('blog', 'BlogController', ['except' => ['show']]);