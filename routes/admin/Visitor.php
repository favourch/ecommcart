<?php
    // Visitors
    Route::delete('visitor/{visitor}/ban', 'VisitorController@ban')->name('visitor.ban');
    Route::get('visitor/{visitor}/unban', 'VisitorController@unban')->name('visitor.unban');
	Route::get('report/getVisitors', 'VisitorController@getVisitors')->name('report.visitors.getMore')->middleware('ajax');
    Route::get('report/visitors', 'VisitorController@index')->name('report.visitors');
