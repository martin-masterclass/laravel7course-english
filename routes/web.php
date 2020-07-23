<?php

use Illuminate\Support\Facades\Route;

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
    return view('starting_page');
});

Route::get('/info', function () {
    return view('info');
});

/*
Route::get('/test/{name}/foo/{age}', 'HobbyController@index');
*/

Route::resource('hobby', 'HobbyController');
Route::resource('tag', 'TagController');
Route::resource('user', 'UserController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Filtered View
Route::get('/hobby/tag/{tag_id}', 'hobbyTagController@getFilteredHobbies')->name('hobby_tag');

// Attach / Detach Tags to Hobbies
Route::get('/hobby/{hobby_id}/tag/{tag_id}/attach', 'hobbyTagController@attachTag');
Route::get('/hobby/{hobby_id}/tag/{tag_id}/detach', 'hobbyTagController@detachTag');

// Delete Images of Hobby
Route::get('/delete-images/hobby/{hobby_id}', 'HobbyController@deleteImages');
// Delete Images of User
Route::get('/delete-images/user/{user_id}', 'UserController@deleteImages');
