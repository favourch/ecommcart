<?php
Route::group(['middleware' => ['install'], 'namespace' => 'Installer', 'as' => 'Installer.', 'prefix' => 'install'], function(){
	Route::get('/', 'WelcomeController@welcome')->name('welcome');
	Route::get('environment', 'EnvironmentController@environmentMenu')->name('environment');
	Route::get('environment/classic', 'EnvironmentController@environmentClassic')->name('environmentClassic');
	Route::post('environment/saveClassic', 'EnvironmentController@saveClassic')->name('environmentSaveClassic');

	Route::get('requirements', 'RequirementsController@requirements')->name('requirements');
	Route::get('permissions', 'PermissionsController@permissions')->name('permissions');
	Route::get('database', 'DatabaseController@database')->name('database');
	Route::get('activate', 'ActivateController@activate')->name('activate');
	Route::post('verify', 'ActivateController@verify')->name('verify');
	Route::get('final', 'FinalController@final')->name('final');
	Route::get('finish', 'FinalController@finish')->name('finish');
	Route::get('demo', 'FinalController@seedDemo')->name('seedDemo');
});