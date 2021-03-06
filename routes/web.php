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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/subscriptions','SubscriptionOffer@index')->name('subscriptions');
Route::get('/home/timeline','DiscussionController@index')->name('timeline');
Route::post('/home/creatediscussion','HomeController@creatediscussion');
Route::post('/home/subscribeuser','HomeController@subscribeuser');
Route::post('/home/followuser','HomeController@followuser');
Route::get('/postcomment','HomeController@postcomment');
//Route::post('/home/postlike','HomeController@postlike');
Route::post('/home/loadcomments','HomeController@loadcomments');

Route::get('/','FactController@index');
Route::get('/facts','FactController@display_fact');
Route::post('/facts/create','FactController@create');
Route::get('/facts/home','FactController@return_home');

Route::get('/landing','HomeController@showlanding');

Route::get('/likepost','HomeController@likepost');


