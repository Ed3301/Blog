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

Route::get('/register', 'Auth\RegisterController@index')->name('register');

Route::group(['middleware' => ['auth']], function () {

		Route::get('/home', 'HomeController@index')->name('home');

		Route::resource('posts', 'PostController');
		Route::get('/my-posts', 'PostController@myPosts')->name('posts.my-posts');
		Route::post('/my-posts', 'PostController@store')->name('posts.my-posts');
		Route::get('/user-posts/{id}', 'UserController@userPosts')->name('posts.user-posts');
		Route::get('/user-country/{id}', 'UserController@userCountry')->name('user-country');
		Route::post('/follow/{post}', 'UserController@follow')->name('follow');
		Route::delete('/follow/{post}', 'UserController@unfollow')->name('unfollow');
		Route::get('user-follows', 'UserController@showFollows')->name('user-follows');

		Route::resource('comments', 'CommentController');
	}
);





