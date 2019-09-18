<?php
	// Faqs
	Route::resource('faqTopic', 'FaqTopicController', ['except' => ['index', 'show']]);
	Route::resource('faq', 'FaqController');