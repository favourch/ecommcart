<?php
	// system
	Route::put('system/maintenanceMode/toggle', 'SystemController@toggleMaintenanceMode')->name('system.maintenanceMode.toggle')->middleware('ajax');

	Route::get('system/general', 'SystemController@view')->name('system.general');

	Route::put('system/updateBasicSystem', 'SystemController@update')->name('basic.system.update');

	Route::get('system/modifyEnvironment', 'SystemController@modifyEnvFile')->name('system.modifyEnvFile')->middleware('ajax');

	Route::post('system/modifyEnvironment', 'SystemController@saveEnvFile')->name('system.saveEnvFile');

	Route::get('system/importDemoContents', 'SystemController@importDemoContents')->name('system.importDemoContents')->middleware('ajax');

	Route::get('system/backup', 'SystemController@backup')->name('system.backup');

	Route::post('system/importDemoContents', 'SystemController@resetDatabase')->name('system.reset');

	Route::get('system/uninstallAppLicense', 'SystemController@uninstallAppLicense')->name('license.uninstall')->middleware('ajax');

	Route::post('system/uninstallAppLicense', 'SystemController@uninstallAppLicense')->name('license.reset');

	Route::get('system/updateAppLicense', 'SystemController@updateAppLicense')->name('license.update');