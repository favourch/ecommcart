<?php
	Route::get('profile', 'AccountController@profile')->name('profile');
	Route::get('billing', 'AccountController@profile')->name('billing');
	Route::get('ticket', 'AccountController@profile')->name('ticket');

	Route::put('update', 'AccountController@update')->name('update');
	Route::get('changePasswordForm', 'AccountController@ShowChangePasswordForm')->name('showChangePasswordForm');
	Route::post('updatePassword', 'AccountController@updatePassword')->name('updatePassword');
	Route::post('updatePhoto', 'AccountController@updatePhoto')->name('updatePhoto');
	Route::get('deletePhoto', 'AccountController@deletePhoto')->name('deletePhoto');

    Route::get('ticket/create', 'AccountController@createTicket')->name('ticket.create');
    Route::post('ticket', 'AccountController@storeTicket')->name('ticket.store');
    Route::get('ticket/{ticket}', 'AccountController@showTicket')->name('ticket.show');
	Route::delete('ticket/{ticket}/archive', 'AccountController@archiveTicket')->name('ticket.archive'); // ticket move to trash
    Route::get('ticket/{ticket}/reply', 'AccountController@replyTicket')->name('ticket.reply');
    Route::post('ticket/{ticket}/storeReply', 'AccountController@storeTicketReply')->name('ticket.storeReply');
