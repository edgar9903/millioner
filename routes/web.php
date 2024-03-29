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
// check type
Route::get('/CheckType', 'GlobalController@CheckType')->name('CheckType');

Route::get('/top', 'GlobalController@top')->middleware('auth')->name('top.rate');

Route::group(['prefix' => 'user','as' => 'user.','namespace' => 'User','middleware' => ['auth','is_user']], function () {

    Route::get('/home', 'UserController@index')->name('home');

    Route::get('/start', 'UserController@start')->name('start.game');

    Route::post('/confirm', 'UserController@confirm')->name('confirm.answer');

    Route::get('/game/{id}', 'UserController@gameInfo')->name('game.info');

});

Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => ['is_admin','auth']], function () {

    Route::resource('question', 'QuestionController');
});