<?php
	// General
	Route::get('paymentMethod', 'PaymentMethodController@index')->name('config.paymentMethod.index');
	Route::get('paymentMethod/{paymentMethod}/activate', 'PaymentMethodController@activate')->name('paymentMethod.activate');
	Route::get('paymentMethod/{paymentMethod}/deactivate', 'PaymentMethodController@deactivate')->name('paymentMethod.deactivate');

	// Manual
	Route::get('manualPaymentMethod/{code}/activate', 'PaymentMethodController@activateManualPaymentMethod')->name('manualPaymentMethod.activate');
	Route::put('manualPaymentMethod/{code}/update', 'PaymentMethodController@updateManualPaymentMethod')->name('manualPaymentMethod.update');
	Route::get('manualPaymentMethod/{code}/deactivate', 'PaymentMethodController@deactivateManualPaymentMethod')->name('manualPaymentMethod.deactivate');

	// Stripe
	Route::get('stripe/connect', 'ConfigStripeController@connect')->name('stripe.connect');
	Route::get('stripe/redirect', 'ConfigStripeController@redirect')->name('stripe.redirect');
	Route::get('stripe/disconnect', 'ConfigStripeController@disconnect')->name('stripe.disconnect');

	// Instamojo
	Route::get('instamojo/activate', 'ConfigInstamojoController@activate')->name('instamojo.activate');
	Route::put('instamojo/{instamojo}/update', 'ConfigInstamojoController@update')->name('instamojo.update');
	Route::get('instamojo/deactivate', 'ConfigInstamojoController@deactivate')->name('instamojo.deactivate');

	// AuthorizeNet
	Route::get('authorizeNet/activate', 'ConfigAuthorizeNetController@activate')->name('authorizeNet.activate');
	Route::put('authorizeNet/{authorizeNet}/update', 'ConfigAuthorizeNetController@update')->name('authorizeNet.update');
	Route::get('authorizeNet/deactivate', 'ConfigAuthorizeNetController@deactivate')->name('authorizeNet.deactivate');

	// PayPal
	Route::get('paypalExpress/activate', 'ConfigPaypalExpressController@activate')->name('paypalExpress.activate');
	Route::put('paypalExpress/{paypalExpress}/update', 'ConfigPaypalExpressController@update')->name('paypalExpress.update');
	Route::get('paypalExpress/deactivate', 'ConfigPaypalExpressController@deactivate')->name('paypalExpress.deactivate');

	// Paystack
	Route::get('paystack/activate', 'ConfigPaystackController@activate')->name('paystack.activate');
	Route::put('paystack/{paystack}/update', 'ConfigPaystackController@update')->name('paystack.update');
	Route::get('paystack/deactivate', 'ConfigPaystackController@deactivate')->name('paystack.deactivate');
