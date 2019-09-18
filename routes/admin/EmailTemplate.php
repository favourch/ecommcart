<?php
	Route::delete('emailTemplate/{emailTemplate}/trash', 'EmailTemplateController@trash')->name('emailTemplate.trash');

	Route::get('emailTemplate/{emailTemplate}/restore', 'EmailTemplateController@restore')->name('emailTemplate.restore');

	Route::resource('emailTemplate', 'EmailTemplateController');