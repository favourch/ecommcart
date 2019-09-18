<?php
Route::delete('category/{category}/trash', 'CategoryController@trash')->name('category.trash'); // category post move to trash

Route::get('category/{category}/restore', 'CategoryController@restore')->name('category.restore');

Route::resource('category', 'CategoryController', ['except' => ['show']]);
