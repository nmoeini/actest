<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/notes', 'NoteController@index');
Route::middleware('auth:api')->post('/notes', 'NoteController@store');
Route::middleware('auth:api')->get('/notes/{note}', 'NoteController@show');
Route::middleware('auth:api')->patch('/notes/{note}', 'NoteController@update');
Route::middleware('auth:api')->delete('/notes/{note}', 'NoteController@destroy');
