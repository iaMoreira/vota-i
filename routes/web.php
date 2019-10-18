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
        Route::get('candidates', 'CandidateController@candidates');
        Route::get('candidate/{urn}', 'CandidateController@index')->name('candidate.index');
        Route::get('candidate/create/{urn}', 'CandidateController@create')->name('candidate.create');
        Route::get('candidate/{candidate}/edit/{urn}', 'CandidateController@edit')->name('candidate.edit');
        Route::put('candidate/{candidate}/update/{urn}', 'CandidateController@update')->name('candidate.update');
        Route::delete('candidate/{candidate}/delete/{urn}', 'CandidateController@destroy')->name('candidate.destroy');
        Route::post('candidate/store/{urn}', 'CandidateController@store')->name('candidate.store');
        Route::get('/home', 'AdminController@home');
    });
    Route::group(['prefix' => 'elector', 'middleware' => 'elector'], function () {
        Route::get('', 'ElectorController@index')->name('elector');
        Route::get('ballot/create/{urn}', 'BallotController@create')->name('ballot.create');
        Route::post('ballot/store', 'BallotController@store')->name('ballot.store');
    });
});

Auth::routes();
Route::get('/', 'HomeController@home')->name('home');
