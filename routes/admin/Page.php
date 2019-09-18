<?php
	// pages
	Route::delete('page/{page}/trash', 'PageController@trash')->name('page.trash'); // page move to trash
	Route::get('page/{page}/restore', 'PageController@restore')->name('page.restore');
	Route::resource('page', 'PageController', ['except' => ['show']]);