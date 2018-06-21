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

Auth::routes();
Route::get ('/',     'HomeController@index');

/*
// テストコード
Route::get ('/testcode/confirming',                 'testcode\confirmingController@showList');
Route::get ('/testcode/confirming/create',          'testcode\confirmingController@create');
Route::post('/testcode/confirming/confirm',         'testcode\confirmingController@confirm');
Route::post('/testcode/confirming/insert',          'testcode\confirmingController@insert');
Route::get ('/testcode/confirming/{id}/edit',       'testcode\confirmingController@edit');
Route::post('/testcode/confirming/{id}/confirm',    'testcode\confirmingController@confirmUpdate');
Route::post('/testcode/confirming/update',          'testcode\confirmingController@update');
Route::get ('/testcode/confirming/{id}/delete',     'testcode\confirmingController@delete');
*/

Route::get ('/www',                           'common\wwwController@index');
Route::get ('/help',                          'common\helpController@index');
