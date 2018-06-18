<?php

/*
|--------------------------------------------------------------------------
| Web Carrier Routes
|--------------------------------------------------------------------------
*/

// 要ログイン
Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['logined']], function () {

        // CARRIER = = = = = = = = = = = =
        Route::group(['middleware' => ['carrier']], function () {
            Route::get ('/carrier',                                 'carrier\homeController@dashboard');
            Route::get ('/carrier/dashboard',                       'carrier\homeController@dashboard');

            // 見積依頼
            Route::get ('/carrier/request',                         'carrier\requestController@showList');
            Route::get ('/carrier/request/{order_id}/detail',       'carrier\requestController@showDetail');

            // 見積作成
            Route::get ('/carrier/estimate',                        'carrier\estimateController@showList');
            Route::get ('/carrier/estimate/{order_id}/list',        'carrier\estimateController@showOrderList');
            Route::get ('/carrier/estimate/{estimate_id}/detail',   'carrier\estimateController@showDetail');
            Route::get ('/carrier/estimate/{order_id}/create',      'carrier\estimateController@create');
            Route::post('/carrier/estimate/confirm',                'carrier\estimateController@confirm');
            Route::post('/carrier/estimate/insert',                 'carrier\estimateController@insert');
            Route::get ('/carrier/estimate/{estimate_id}/edit',     'carrier\estimateController@edit');
            Route::post('/carrier/estimate/{estimate_id}/confirm',  'carrier\estimateController@confirmUpdate');
            Route::post('/carrier/estimate/update',                 'carrier\estimateController@update');
            Route::get ('/carrier/estimate/{estimate_id}/delete',   'carrier\estimateController@delete');
            Route::get ('/carrier/estimate/{estimate_id}/duplicate','carrier\estimateController@duplicate');

            // 見積用商品
            Route::get ('/carrier/item',                            'carrier\itemController@showList');
            Route::get ('/carrier/item/{item_id}/detail',           'carrier\itemController@showDetail');
            Route::get ('/carrier/item/create',                     'carrier\itemController@create');
            Route::post('/carrier/item/insert',                     'carrier\itemController@insert');
            Route::get ('/carrier/item/{item_id}/edit',             'carrier\itemController@edit');
            Route::post('/carrier/item/update',                     'carrier\itemController@update');
            Route::get ('/carrier/item/{item_id}/delete',           'carrier\itemController@delete');

            // ご提案
            Route::get ('/carrier/suggest/{estimate_id}/create',    'carrier\suggestController@create');
            Route::post('/carrier/suggest/confirm',                 'carrier\suggestController@confirm');
            Route::post('/carrier/suggest/execute',                 'carrier\suggestController@execute');

            // 未受注の案件
            Route::get ('/carrier/pre_work',                        'carrier\preWorkController@showList');
            Route::get ('/carrier/pre_work/{work_id}/detail',       'carrier\preWorkController@showDetail');
            // 受注進行中の案件
            Route::get ('/carrier/active_work',                     'carrier\activeWorkController@showList');
            // 終了した案件
            Route::get ('/carrier/closed_work',                     'carrier\closedWorkController@showList');
            // 案件詳細
            Route::get ('/carrier/work/{work_id}/detail',           'carrier\workController@showDetail');

            // 受注
            Route::get ('/carrier/receive/{work_id}/create',        'carrier\receiveController@create');
            Route::post('/carrier/receive/confirm',                 'carrier\receiveController@confirm');
            Route::post('/carrier/receive/execute',                 'carrier\receiveController@execute');

            // 完了報告
            Route::get ('/carrier/report/{work_id}/create',         'carrier\reportController@create');
            Route::post('/carrier/report/confirm',                  'carrier\reportController@confirm');
            Route::post('/carrier/report/execute',                  'carrier\reportController@execute');

            // 入金確認報告
            Route::get ('/carrier/confirm_payment/{work_id}',       'carrier\confirmPaymentController@execute');

            // 運送会社評価
            Route::get ('/carrier/review/{work_id}/create',         'carrier\reviewController@create');
            Route::post('/carrier/review/confirm',                  'carrier\reviewController@confirm');
            Route::post('/carrier/review/execute',                  'carrier\reviewController@execute');

            // コンタクトボード
            Route::get ('/carrier/board/{work_id}',                 'carrier\boardController@detail');

            // 運送会社情報
            Route::get ('/carrier/account/',                        'carrier\accountController@showDetail');
            Route::get ('/carrier/account/base/edit',               'carrier\accountController@editBase');
            Route::post('/carrier/account/base/update',             'carrier\accountController@updateBase');
            Route::get ('/carrier/account/car/edit',                'carrier\accountController@editCars');
            Route::post('/carrier/account/car/update',              'carrier\accountController@updateCars');
            Route::get ('/carrier/account/empty/edit',              'carrier\accountController@editEmpties');
            Route::post('/carrier/account/empty/update',            'carrier\accountController@updateEmpties');
        });
    });

});
