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
//Route::get ('/',     'HomeController@index');

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

Route::get ('/',                                        'common\wwwController@index');
Route::get ('/trucks',                                  'common\wwwController@trucks');

Route::get ('/delivery_services/{order_id}/detail',     'common\deliveryServiceController@detail');
Route::get ('/delivery_services',                       'common\deliveryServiceController@index');
Route::get ('/delivery_services/withintoday',           'common\deliveryServiceController@withintoday');
Route::get ('/delivery_services/fewdays',               'common\deliveryServiceController@fewdays');
Route::get ('/delivery_services/Regularly',             'common\deliveryServiceController@Regularly');
Route::get ('/delivery_services/Occasionally',          'common\deliveryServiceController@Occasionally');
Route::get ('/delivery_services/Category/{class_id}',   'common\deliveryServiceController@Category');
Route::get ('/delivery_services/search',                'common\deliveryServiceController@search');
/*
Route::get ('/transporter',                     'common\transporterController@index');
Route::get ('/transporter/driver',              'common\transporterController@driver');
Route::get ('/transporter/carrier',             'common\transporterController@carrier');
Route::get ('/transporter/ranking',             'common\transporterController@ranking');
*/
Route::get ('/company',                         'common\wwwController@company');
Route::get ('/compliance',                      'common\wwwController@compliance');
Route::get ('/transportation',                  'common\wwwController@transportation');
Route::get ('/qa',                              'common\wwwController@qa');

Route::get ('/safety',                          'common\wwwController@safety');
Route::get ('/corporate/rules',                 'common\wwwController@corporateRules');
Route::get ('/tokushoho',                       'common\wwwController@tokushoho');
Route::get ('/privacypolicy',                   'common\wwwController@privacypolicy');
Route::get ('/campaign',                        'common\wwwController@campaign');

Route::get ('/transport_news',                  'common\transportNewsController@index');

// お問い合わせ
Route::get ('/contact',                         'common\contactController@create');
Route::post('/contact/confirm',                 'common\contactController@confirm');
Route::post('/contact/execute',                 'common\contactController@execute');
Route::get ('/contact/complete',                'common\contactController@complete');

Route::get ('/mailbody/authorization/email',    function(){ return view('mailbody.authorization.email', ['code' => 'hoge']); });
Route::get ('/mailbody/authorization/password', function(){ return view('mailbody.authorization.passwordreset', ['reset_url' => 'hoge']); });
Route::get ('/mailbody/contact/complete',       function(){ return view('mailbody.contact.complete'); });
Route::get ('/mailbody/signup/email',           function(){ return view('mailbody.signup.email', ['key' => 'hoge']); });

