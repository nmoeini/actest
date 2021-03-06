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

Route::get('/notes', 'NoteController@index');
Route::post('/notes', 'NoteController@store');
Route::get('/notes/{note}', 'NoteController@show');
Route::patch('/notes/{note}', 'NoteController@update');
Route::delete('/notes/{note}', 'NoteController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/settings', 'SettingsController@index')->name('settings');
