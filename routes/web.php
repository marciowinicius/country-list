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

Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);
Route::get('/country-list', ['as' => 'country-list', 'uses' => 'HomeController@showListView']);
Route::get('/download-csv', ['as' => 'download-csv', 'uses' => 'HomeController@csv']);
Route::get('/download-xls', ['as' => 'download-xls', 'uses' => 'HomeController@xls']);
