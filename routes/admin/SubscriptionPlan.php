<?php
	// SubscriptionPlans
	Route::delete('subscriptionPlan/{subscriptionPlan}/trash', 'SubscriptionPlanController@trash')->name('subscriptionPlan.trash');
	Route::get('subscriptionPlan/{subscriptionPlan}/restore', 'SubscriptionPlanController@restore')->name('subscriptionPlan.restore');
	Route::post('subscriptionPlan/reorder', 'SubscriptionPlanController@reorder')->name('subscriptionPlan.reorder');
	Route::resource('subscriptionPlan', 'SubscriptionPlanController');
