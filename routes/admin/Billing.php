<?php
    // $router->post('/settings/subscription', 'Settings\Subscription\PlanController@store');
    // $router->put('/settings/subscription', 'Settings\Subscription\PlanController@update');
    // $router->delete('/settings/subscription', 'Settings\Subscription\PlanController@destroy');
    // Invoices...
    // $router->get('/settings/invoices', 'Settings\Billing\InvoiceController@all');
    // $router->get('/settings/invoice/{id}', 'Settings\Billing\InvoiceController@download');

	Route::put('card/update', 'SubscriptionController@updateCardinfo')->name('card.update');
	Route::get('features/{subscriptionPlan}', 'SubscriptionController@features')->name('subscription.features');
	Route::get('subscribe/{plan}/{merchant?}', 'SubscriptionController@subscribe')->name('subscribe');
	Route::get('subscription/resume', 'SubscriptionController@resumeSubscription')->name('subscription.resume');
	Route::delete('subscription/cancel', 'SubscriptionController@cancelSubscription')->name('subscription.cancel');
