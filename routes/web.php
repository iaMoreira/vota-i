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

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
        Route::resource('urn', 'UrnController');
        Route::resource('user', 'UserController');
        Route::get('candidates', 'AdminCandidateController@candidates');
        Route::get('candidate/{urn}', 'AdminCandidateController@index')->name('candidate.index');
        Route::get('candidate/create/{urn}', 'AdminCandidateController@create')->name('candidate.create');
        Route::get('candidate/{candidate}/edit/{urn}', 'AdminCandidateController@edit')->name('candidate.edit');
        Route::put('candidate/{candidate}/update/{urn}', 'AdminCandidateController@update')->name('candidate.update');
        Route::delete('candidate/{candidate}/delete/{urn}', 'AdminCandidateController@destroy')->name('candidate.destroy');
        Route::post('candidate/store/{urn}', 'AdminCandidateController@store')->name('candidate.store');
        Route::get('/home', 'AdminController@home');
    });
    Route::group(['prefix' => 'candidate', 'middleware' => 'candidate'], function () {
        Route::get('', 'CandidateController@index')->name('candidate');
        Route::get('ballot/create/{urn}', 'BallotController@create')->name('ballot.create');
        Route::post('ballot/store', 'BallotController@store')->name('ballot.store');
    });
});

Auth::routes();
Route::get('/', 'HomeController@home')->name('home');
// Route::get('/auth', 'Auth\LoginController@auth');
