<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('dashboard', 'HelperController@to_dashboard');
Route::group(['prefix' => 'admin', 'middleware'=>'auth'], function() {
	
	
	
	/*posts*/
    Route::get('posts', ['as'=>'allposts', 'uses'=>'PostsController@post_all'] );
	Route::get('posts/edit/{post}', 'PostsController@post_edit');
	Route::put('posts/edit/{post}', 'PostsController@post_update');
	Route::get('posts/new', 'PostsController@post_new');
	Route::post('posts/new', ['as'=>'postcreate', 'uses'=>'PostsController@post_store']);
	Route::delete('posts/{post}/delete', 'PostsController@post_delete');
	Route::delete('posts/multidelete', 'PostsController@multidelete');
	
	/*pages*/
	Route::get('pages', ['as'=>'allpages', 'uses'=>'PostsController@page_all']);

	
	/*categories*/
	Route::get('categories', ['as'=>'allcats', 'uses'=>'CategoryController@index']);
	Route::post('categories',  'CategoryController@store');
	Route::put('categories/{catergory}',  'CategoryController@update');
	Route::delete('categories/{catergory}/delete',  'CategoryController@destroy');
	
	
	/* media library*/
	Route::get('uploads', 'UploadController@index');
	Route::any('uploads/all', 'UploadController@get_all_media');
	Route::post('uploads/store', ['as' => 'image.store' , 'uses' => 'UploadController@store']);
	Route::delete('uploads/{media}/delete', ['as' => 'media.delete' , 'uses' => 'UploadController@delete']);
	
	/*users*/
	Route::get('users', ['as'=>'allusers', 'uses'=>'UsersController@index']);
	Route::get('users/edit/{user}', 'UsersController@edit');
	Route::put('users/edit/{user}', 'UsersController@update');
	Route::get('users/new', 'UsersController@create');
	Route::post('users/new', ['as'=>'usercreate', 'uses'=>'UsersController@store']);
	Route::delete('users/{user}/delete', 'UsersController@delete');
	
	/*****menus***/
	Route::get('menus', 'HelperController@menus');
	Route::post('menus', 'HelperController@new_menu');
	Route::post('menus/{menu}', 'HelperController@current_menu');
	
	Route::get('addon', 'HelperController@addons');
	
	Route::get('widgets', 'HelperController@widget_all');
	
	Route::get('settings', 'HelperController@settings');
});
Route::get('/', ['as'=>'index', 'uses'=>'FrontController@loop_posts'] );
Route::get('/frontview', ['as'=>'posts', 'uses'=>'FrontController@loop_posts']);
Route::get('/frontview/{post_slug}', ['as'=>'post_single', 'uses'=>'FrontController@single_post']);

Auth::routes();


