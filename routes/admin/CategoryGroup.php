<?php
Route::delete('categoryGroup/{categoryGrp}/trash', 'CategoryGroupController@trash')->name('categoryGroup.trash'); // category post move to trash

Route::get('categoryGroup/{categoryGrp}/restore', 'CategoryGroupController@restore')->name('categoryGroup.restore');

Route::resource('categoryGroup', 'CategoryGroupController', ['except' => ['show']]);