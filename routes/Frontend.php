<?php
// Route for storefront
Route::group(['middleware' => ['storefront'], 'namespace' => 'Storefront'], function(){
	Route::post('newsletter', 'NewsletterController@subscribe')->name('newsletter.subscribe');

   // Auth route for customers
	include('storefront/Auth.php');
	include('storefront/Cart.php');
	include('storefront/Order.php');
	include('storefront/GiftCard.php');

	Route::middleware(['auth:customer'])->group(function () {
		include('storefront/Account.php');
		include('storefront/Feedback.php');
	});

	Route::get('/', 'HomeController@index')->name('homepage');
	Route::get('page/{page}', 'HomeController@openPage')->name('page.open');
	Route::get('product/{slug}', 'HomeController@product')->name('show.product');
	Route::get('product/{slug}/quickView', 'HomeController@quickViewItem')->name('quickView.product')->middleware('ajax');
	Route::get('product/{slug}/offers', 'HomeController@offers')->name('show.offers');
	Route::get('categories', 'HomeController@categories')->name('categories');
	Route::get('category/{slug}', 'HomeController@browseCategory')->name('category.browse');
	Route::get('categories/{slug}', 'HomeController@browseCategorySubGrp')->name('categories.browse');
	Route::get('categorygrp/{slug}', 'HomeController@browseCategoryGroup')->name('categoryGrp.browse');
	Route::get('shop/{slug}', 'HomeController@shop')->name('show.store');
	// Route::get('shop/reviews/{slug}', 'HomeController@shopReviews')->name('reviews.store');
	Route::get('brand/{slug}', 'HomeController@brand')->name('show.brand');
	Route::get('locale/{locale?}', 'HomeController@changeLanguage')->name('locale.change');
	Route::get('search', 'SearchController@search')->name('inCategoriesSearch');
	Route::get('blog', 'BlogController@index')->name('blog');
	Route::any('blog/search', 'BlogController@search')->name('blog.search');
	Route::get('blog/{slug}', 'BlogController@show')->name('blog.show');
	Route::get('blog/author/{author}', 'BlogController@author')->name('blog.author');
	Route::get('blog/tag/{tag}', 'BlogController@tag')->name('blog.tag');
});

// Route for merchant landing theme
Route::group(['middleware' => ['selling'], 'namespace' => 'Selling'], function(){
	Route::get('selling', 'SellingController@index')->name('selling');
});

// // Route for customers
// Route::group(['as' => 'customer.', 'prefix' => 'customer'], function() {
// 	// include('storefront/Auth.php');
// });
