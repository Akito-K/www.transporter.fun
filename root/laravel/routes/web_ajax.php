<?php

/*
|--------------------------------------------------------------------------
| Web Ajax Routes
|--------------------------------------------------------------------------
|
*/

Route::post('/ajax/upload_file',                            'AjaxController@uploadFile');
Route::post('/ajax/upload_some_file',                       'AjaxController@uploadSomeFile');
Route::post('/ajax/quote_user_account',                     'AjaxController@quoteUserAccount');
Route::post('/ajax/quote_address',                          'AjaxController@quoteAddress');
Route::post('/ajax/add_estimate_item',                      'AjaxController@addEstimateItem');
Route::post('/ajax/quote_item',                             'AjaxController@quoteItem');
Route::post('/ajax/quote_order',                            'AjaxController@quoteOrder');

Route::post('/ajax/get_over10',                             'AjaxController@getOver10');
Route::post('/ajax/put_message',                            'AjaxController@putMessage');
Route::post('/ajax/upload_file_and_put_board_file',         'AjaxController@uploadFileAndPutBoardFile');
Route::post('/ajax/refresh_messages',                       'AjaxController@refreshMessages');
Route::post('/ajax/get_unread_count',                       'AjaxController@getUnreadCount');

Route::post('/ajax/add_edit_car',                           'AjaxController@addEditCar');
Route::post('/ajax/add_edit_empty',                         'AjaxController@addEditEmpty');
//Route::post('/ajax/add_estimate_item',                      'AjaxController@addEstimateItem');

//Route::get ('/cron/run', 'cronController@logWeather');
