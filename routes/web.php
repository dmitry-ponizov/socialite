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

Route::get('/login/facebook', 'Auth\LoginController@redirectToFacebookProvider');

Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderFacebookCallback');


Route::group(['middleware' => [
    'auth'
]], function(){

    Route::get('/user', 'GraphController@retrieveUserProfile');

    Route::post('/user', 'GraphController@publishToProfile')->name('publish.profile.message');

    Route::post('/page', 'GraphController@publishToPage')->name('publish.page');

    Route::post('/page/image', 'GraphController@publishImageToPage')->name('publish.image.page');

});