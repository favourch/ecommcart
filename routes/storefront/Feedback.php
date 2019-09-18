<?php
	Route::get('order/feedback/{order}', 'FeedbackController@feedback_form')->name('order.feedback');
	Route::post('order/feedback/{order}', 'FeedbackController@save_product_feedbacks')->name('save.feedback');
	Route::post('shop/feedback/{order}', 'FeedbackController@save_shop_feedbacks')->name('shop.feedback');
