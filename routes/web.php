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
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {



	/* posts */
	Route::get('posts', ['as' => 'allposts', 'uses' => 'PostsController@post_all']);
	Route::get('posts/edit/{post}', 'PostsController@post_edit');
	Route::put('posts/edit/{post}', 'PostsController@post_update');
	Route::get('posts/new', 'PostsController@post_new');
	Route::post('posts/new', ['as' => 'postcreate', 'uses' => 'PostsController@post_store']);
	Route::delete('posts/{post}/delete', 'PostsController@post_delete');
	Route::delete('posts/multidelete', 'PostsController@multidelete');

	/* pages */
	Route::get('pages', ['as' => 'allpages', 'uses' => 'PostsController@page_all']);


	/* categories */
	Route::get('categories', ['as' => 'allcats', 'uses' => 'CategoryController@index']);
	Route::post('categories', 'CategoryController@store');
	Route::put('categories/{catergory}', 'CategoryController@update');
	Route::delete('categories/{catergory}/delete', 'CategoryController@destroy');
	Route::delete('categories/multidelete', 'CategoryController@multidelete');


	Route::get('library', 'HelperController@show_media');

	/* users */
	Route::get('users', ['as' => 'allusers', 'uses' => 'UsersController@index']);
	Route::get('users/edit/{user}', 'UsersController@edit');
	Route::put('users/edit/{user}', 'UsersController@update');
	Route::get('users/new', 'UsersController@create');
	Route::post('users/new', ['as' => 'usercreate', 'uses' => 'UsersController@store']);
	Route::delete('users/{user}/delete', 'UsersController@delete');

	/*	 * ***menus** */
	Route::get('menus', 'HelperController@menus');
	Route::post('menus', 'HelperController@new_menu');
	Route::post('menus/{menu}', 'HelperController@current_menu');

	Route::get('addon', 'HelperController@addons');

	Route::get('widgets', 'HelperController@widget_all');

	Route::get('settings', 'HelperController@settings');
});
Route::get('/', ['as' => 'index', 'uses' => 'FrontController@loop_posts']);
Route::get('/frontview', ['as' => 'posts', 'uses' => 'FrontController@loop_posts']);
Route::get('/frontview/{post_slug}', ['as' => 'post_single', 'uses' => 'FrontController@single_post']);

Auth::routes();

/* media library */
$middleware = array_merge(\Config::get('lfm.middlewares'), ['\Unisharp\Laravelfilemanager\middleware\MultiUser']);
$prefix = \Config::get('lfm.prefix', 'laravel-filemanager');
$as = 'unisharp.lfm.';
$namespace = '\Unisharp\Laravelfilemanager';

// make sure authenticated
Route::group(['middleware'=>$middleware, 'as'=>$as, 'prefix'=>$prefix, 'namespace'=>$namespace], function () {
	
	
		// Show LFM
		Route::get('/', ['uses' => '\Unisharp\Laravelfilemanager\controllers\LfmController@show','as' => 'show']);

		// upload
		Route::any('/upload', ['uses' => '\Unisharp\Laravelfilemanager\controllers\UploadController@upload',	'as' => 'upload']);

		// list images & files
		Route::get('/jsonitems', ['uses' => '\Unisharp\Laravelfilemanager\controllers\ItemsController@getItems',	'as' => 'getItems']);

		// folders
		Route::get('/newfolder', ['uses' => '\Unisharp\Laravelfilemanager\controllers\FolderController@getAddfolder','as' => 'getAddfolder']);
		Route::get('/deletefolder', ['uses' => '\Unisharp\Laravelfilemanager\controllers\FolderController@getDeletefolder','as' => 'getDeletefolder']);
		Route::get('/folders', ['uses' => '\Unisharp\Laravelfilemanager\controllers\FolderController@getFolders','as' => 'getFolders']);

		// crop
		Route::get('/crop', ['uses' => '\Unisharp\Laravelfilemanager\controllers\CropController@getCrop','as' => 'getCrop']);
		Route::get('/cropimage', ['uses' => '\Unisharp\Laravelfilemanager\controllers\CropController@getCropimage','as' => 'getCropimage']);

		// rename
		Route::get('/rename', ['uses' => '\Unisharp\Laravelfilemanager\controllers\RenameController@getRename','as' => 'getRename']);

		// scale/resize
		Route::get('/resize', ['uses' => '\Unisharp\Laravelfilemanager\controllers\ResizeController@getResize','as' => 'getResize']);
		Route::get('/doresize', ['uses' => '\Unisharp\Laravelfilemanager\controllers\ResizeController@performResize','as' => 'performResize']);

		// download
		Route::get('/download', ['uses' => '\Unisharp\Laravelfilemanager\controllers\DownloadController@getDownload', 'as' => 'getDownload']);

		// delete
		Route::get('/delete', ['uses' => '\Unisharp\Laravelfilemanager\controllers\DeleteController@getDelete','as' => 'getDelete']);
		Route::get('/demo', function () {return view('laravel-filemanager::demo');});
	});




