<?php
Route::delete('categorySubGroup/{categorySubGroup}/trash', 'CategorySubGroupController@trash')->name('categorySubGroup.trash'); // category post move to trash

Route::get('categorySubGroup/{categorySubGroup}/restore', 'CategorySubGroupController@restore')->name('categorySubGroup.restore');

Route::resource('categorySubGroup', 'CategorySubGroupController', ['except' => ['show']]);