<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('login', 'UserController@showLogin');
Route::post('login', 'UserController@doLogin');
Route::get('logout', 'UserController@doLogout');
Route:: get('home', 'PageController@homepage');


Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});


// ========================User Controller===================================

Route::group( ['middleware' => 'auth' ], function()
{
    Route::get('orders_list', 'UserController@orders_list');
    Route::get('order_details/{id}', 'UserController@order_details');
    Route::get('my_account', 'UserController@my_account');
	Route::get('upload_prescription', 'UserController@upload_prescription');
	Route::get('product_reviews', 'UserController@product_reviews');
	Route::get('wishlist', 'UserController@wishlist');
	Route::get('newsletter_subscription', 'UserController@newsletter_subscription');
	Route::get('loyality_points', 'UserController@loyality_points');
	Route::get('manage_address', 'UserController@manage_address');
	Route::get('add_address', 'UserController@add_address');
	Route::get('editmanage_address/{id}', 'UserController@editmanage_address');
	Route::get('updatemanage_address/{id}', 'UserController@editmanage_address');
	Route::get('deletemanage_address/{id}', 'UserController@deletemanage_address');
});

Route::get('/', 'PageController@homepage');
Route::get('search', 'PageController@search');
Route::get('{slug}', 'PageController@searchSelectData');
Route::get('searchData', 'PageController@searchSelectDataButton');
Route::get('/status', 'PageController@status');
