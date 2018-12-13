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
    return view('index');
})->name('home');

Route::get('/category/get-all', 'CategoryController@getAllWithVideos');
Route::get('/user/get-all', 'UserController@getAll');
Route::get('/video/add-view/{id}', 'VideoController@addView');



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
        Route::get('/promote', 'DashboardController@promote')->name('promote-video');
        Route::get('/go-live/{id}', 'DashboardController@goLive')->name('go-live');
    });

    Route::group(['prefix'=> 'admin', 'middleware' =>['admin']], function (){
        Route::get('/index', 'AdminController@index')->name('admin.home');
        Route::get('/video', 'AdminController@video')->name('admin.videos');
        Route::get('/video/approve/{id}', 'AdminController@approve');
        Route::post('/add-category', 'CategoryController@add')->name('add-category');
    });
});