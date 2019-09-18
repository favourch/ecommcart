<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api'], function(){
	Route::get('sliders', 'HomeController@sliders');
	Route::get('banners', 'HomeController@banners');
	Route::get('categories', 'CategoryController@index');
	Route::get('category-grps', 'CategoryController@categoryGroup');
	Route::get('category-subgrps', 'CategoryController@categorySubGroup');
	Route::get('countries', 'HomeController@countries');
	Route::get('states/{country}', 'HomeController@states');

	Route::get('page/{slug}', 'HomeController@page');
	Route::get('shop/{slug}', 'HomeController@shop');
	Route::get('packaging/{shop}', 'HomeController@packaging');
	Route::get('paymentOptions/{shop}', 'HomeController@paymentOptions');
	Route::get('offers/{slug}', 'HomeController@offers');
	Route::get('listings/{list?}', 'ListingController@index');
	Route::get('listing/{slug}', 'ListingController@item');
	Route::get('search/{term}', 'ListingController@search');
	Route::get('shop/{slug}/listings', 'ListingController@shop');
	Route::get('category/{slug}', 'ListingController@category');
	Route::get('brand/{slug}', 'ListingController@brand');

	// CART
	Route::group(['middleware' => 'ajax'], function(){
		Route::post('addToCart/{slug}', 'CartController@addToCart');
		Route::post('cart/removeItem', 'CartController@remove');
	});

	// Route::group(['middleware' => 'auth:customer'], function(){
		Route::post('cart/{cart}/applyCoupon', 'CartController@validateCoupon');
		// Route::post('cart/{cart}/applyCoupon', 'CartController@validateCoupon')->middleware(['ajax']);
	// });

	Route::get('carts', 'CartController@index');
	// Route::put('cart/{cart}', 'CartController@update');
	Route::post('cart/{cart}/shipTo', 'CartController@shipTo');
	Route::post('cart/{cart}/checkout', 'CheckoutController@checkout');

	// Route::get('cart/{expressId?}', 'CartController@index')->name('cart.index');
	// Route::get('checkout/{slug}', 'CheckoutController@directCheckout');

	Route::post('register', 'AuthController@register');
	Route::post('login', 'AuthController@login');
	Route::post('logout', 'AuthController@logout');

});


// Route::group(['middleware' => 'auth:api'], function() {
//     Route::get('articles', 'ArticleController@index');
//     Route::get('articles/{article}', 'ArticleController@show');
//     Route::post('articles', 'ArticleController@store');
//     Route::put('articles/{article}', 'ArticleController@update');
//     Route::delete('articles/{article}', 'ArticleController@delete');
// });