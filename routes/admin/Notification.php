<?php
	Route::get('notifications', 'NotificationController@index')->name('notifications');

	Route::get('notifications.markAsRead', 'NotificationController@markAllNotificationsAsRead')->name('notifications.markAllAsRead')->middleware('ajax');

	Route::delete('notifications/{notification}', 'NotificationController@destroy')->name('notifications.delete');

	Route::delete('notifications', 'NotificationController@destroyAll')->name('notifications.deleteAll');
