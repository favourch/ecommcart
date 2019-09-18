<?php
	// Support Tickets
	Route::delete('ticket/{ticket}/archive', 'TicketController@archive')->name('ticket.archive'); // ticket move to trash

    Route::get('ticket/{ticket}/reply', 'TicketController@reply')->name('ticket.reply');

    Route::post('ticket/{ticket}/storeReply', 'TicketController@storeReply')->name('ticket.storeReply');

    Route::post('ticket/{ticket}/reopen', 'TicketController@reopen')->name('ticket.reopen');

    Route::get('ticket/{ticket}/showAssignForm', 'TicketController@showAssignForm')->name('ticket.showAssignForm');

    Route::post('ticket/{ticket}/assign', 'TicketController@assign')->name('ticket.assign');

    // Route::get('ticket/search/{text}', 'TicketController@search')->name('ticket.search');
    // Route::post('ticket/{ticket}/comments', 'CommentsController@store')->name('comments.store');

	Route::resource('ticket', 'TicketController', ['only' => ['index', 'show', 'edit', 'update']]);
