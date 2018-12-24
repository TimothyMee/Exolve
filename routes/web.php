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

Route::get('/check/auth', function (){
    return apiSuccess(auth()->id());
});
Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/category/get-all', 'CategoryController@getAllWithVideos');
Route::get('/user/get-all', 'UserController@getAll');
Route::get('/video/add-view/{id}', 'VideoController@addView');
Route::get('/video/details/{id}', 'VideoController@OpenVideoDetails');
Route::get('/video/get-details/{id}', 'VideoController@getVideoDetails');
Route::get('/video/comment/{id}', 'CommentController@getComment');
Route::get('/search/{param}', 'VideoController@search');



Route::post('/sign-up', 'UserController@create')->name('sign-up');
Route::post('/login', 'UserController@postLogin')->name('login');
Route::get('/logout', 'UserController@logout')->name('logout');


Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'dashboard'], function (){
        Route::get('/index', 'DashboardController@index')->name('dashboard');
        Route::post('/edit-profile', 'UserController@edit')->name('edit-profile');
        Route::get('/add', 'DashboardController@add')->name('add-video');
        Route::post('/add', 'DashboardController@addVideo')->name('upload-video');
        Route::get('/pending', 'DashboardController@pending')->name('pending-video');
        Route::get('/pending-api', 'DashboardController@pendingApi');
        Route::get('/video/details/{id}', 'VideoController@OpenVideoDetails');
//        Route::get('/promote', 'DashboardController@promote')->name('promote-video');
//        Route::get('/go-live/{id}', 'DashboardController@goLive')->name('go-live');
    });
    Route::post('/video/comment', 'VideoController@comment')->name('addComment');
    Route::post('/video/rating', 'VideoController@rateVideo');
    Route::get('/video/average-ratings/{id}', 'RatingController@getVideoRating');
    Route::get('/video/rating/{id}', 'RatingController@getRating');

    Route::group(['prefix'=> 'admin', 'middleware' =>['admin']], function (){
        Route::get('/index', 'AdminController@index')->name('admin.home');
        Route::get('/categories', 'AdminController@categories')->name('admin.categories');
        Route::get('/video', 'AdminController@video')->name('admin.videos');
        Route::get('/video/approve/{id}', 'AdminController@approve');
        Route::get('/video/remove/{id}', 'AdminController@remove');
        Route::post('/add-category', 'CategoryController@add')->name('add-category');
        Route::get('/video/details/{id}', 'VideoController@adminGetVideo');
        Route::get('/video/all', 'VideoController@getAllVideos');
        Route::get('/video/pending', 'VideoController@getPending');
        Route::get('/get/statistics', 'AdminController@getStatistics');
        Route::get('/users/get', 'AdminController@getUsers');
    });
});