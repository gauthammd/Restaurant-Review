<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/', 'PageController@index');
Route::get('/', 'RestaurantController@index');
Route::get('/about', 'PageController@about');
Route::get('/services', 'PageController@services');
Route::post('/restaurants/{restaurant}/comments', 'CommentController@store');
Route::get('/search/{name}', 'RestaurantController@search');

Route::resource('restaurants', 'RestaurantController');
Route::resource('profile', 'ProfileController');
/*Route::get('/', function () {
    return view('home');
});


Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
