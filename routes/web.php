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

Route::get('/', 'PagesController@getGuestBook');
Route::get('guestbook', 'PagesController@getGuestBook');
Route::get('edit/{id}', 'PagesController@getEdit')->name('edit');
Route::get('response/{id}', 'PagesController@getResponse')->name('response');
Route::post('addMessage', 'PagesController@postAddMessage')->name('addMessage');
Route::post('messageValidate', 'PagesController@postMessageValidate')->name('messageValidate');


Route::get('signup', 'Auth\RegisterController@getSignupForm')->name('signup');
Route::post('signup', 'Auth\RegisterController@postSignupForm')->name('signup');
Route::post('signupValidate', 'Auth\RegisterController@postSignupValidate')->name('signupValidate');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', 'Auth\LoginController@logout')->name('logoutGet');

