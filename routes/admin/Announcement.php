<?php
	// Announcement
	Route::get('announcement.read', 'AnnouncementController@read')->name('announcement.read')->middleware('ajax');
	Route::resource('announcement', 'AnnouncementController', ['except' => ['show']]);