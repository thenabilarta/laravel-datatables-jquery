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

Route::get('/', 'AppController@index')->name('app.index');
Route::get('/data', 'AppController@data');
Route::post('/upload', 'AppController@upload');
Route::get('/uploadTes', 'AppController@uploadTes');
Route::get('/media', 'AppController@media')->name('app.media');
