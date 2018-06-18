<?php

/*
|--------------------------------------------------------------------------
| Web Owner Routes
|--------------------------------------------------------------------------
*/

// 要ログイン
Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['logined']], function () {

        // OWNER = = = = = = = = = = = =
        Route::group(['middleware' => ['owner']], function () {
            Route::get ('/owner',                                   'owner\homeController@dashboard');
            Route::get ('/owner/dashboard',                         'owner\homeController@dashboard');

            // 案件
            Route::get ('/owner/order/create',                      'owner\orderController@create');
            Route::post('/owner/order/confirm',                     'owner\orderController@confirm');
            Route::post('/owner/order/insert',                      'owner\orderController@insert');
            Route::get ('/owner/order/{order_id}/edit',             'owner\orderController@edit');
            Route::post('/owner/order/{order_id}/confirm',          'owner\orderController@confirmUpdate');
            Route::post('/owner/order/update',                      'owner\orderController@update');
            Route::get ('/owner/order/{order_id}/delete',           'owner\orderController@delete');
            Route::get ('/owner/order/{order_id}/duplicate',        'owner\orderController@duplicate');

            // 未発注の案件
            Route::get ('/owner/pre_order',                         'owner\preOrderController@showList');
            Route::get ('/owner/pre_order/{order_id}/detail',       'owner\preOrderController@showDetail');
            // 進行中の案件
            Route::get ('/owner/active_order',                      'owner\activeOrderController@showList');
            Route::get ('/owner/active_order/{order_id}/detail',    'owner\activeOrderController@showDetail');
            // 終了した案件
            Route::get ('/owner/closed_order',                      'owner\closedOrderController@showList');
            Route::get ('/owner/closed_order/{order_id}/detail',    'owner\closedOrderController@showDetail');

            // 見積依頼
            Route::get ('/owner/request/{order_id}/create',         'owner\requestController@create');
            Route::post('/owner/request/confirm',                   'owner\requestController@confirm');
            Route::post('/owner/request/execute',                   'owner\requestController@execute');
            Route::get ('/owner/request/{order_id}/cancel',         'owner\requestController@cancel');

            // 提案のあった見積
            Route::get ('/owner/estimate/{order_id}/list',          'owner\estimateController@showOrderList');
            Route::get ('/owner/estimate/{estimate_id}/detail',     'owner\estimateController@showDetail');

            // 発注
            Route::get ('/owner/place/{estimate_id}/create',        'owner\placeController@create');
            Route::post('/owner/place/confirm',                     'owner\placeController@confirm');
            Route::post('/owner/place/execute',                     'owner\placeController@execute');
            // お断り
            Route::get ('/owner/reject/{estimate_id}',              'owner\rejectController@execute');

            // 入金通知
            Route::get ('/owner/payed/{estimate_id}/create',        'owner\payedController@create');
            Route::post('/owner/payed/confirm',                     'owner\payedController@confirm');
            Route::post('/owner/payed/execute',                     'owner\payedController@execute');

            // 運送会社評価
            Route::get ('/owner/review/{order_id}/create',          'owner\reviewController@create');
            Route::post('/owner/review/confirm',                    'owner\reviewController@confirm');
            Route::post('/owner/review/execute',                    'owner\reviewController@execute');

            // コンタクトボード
            Route::get ('/owner/board/order/{order_id}',            'owner\boardController@detailByOrder');
            Route::get ('/owner/board/estimate/{estimate_id}',      'owner\boardController@detailByEstimate');

            // 荷主情報
            Route::get ('/owner/account/',                          'owner\accountController@showDetail');
            Route::get ('/owner/account/base/edit',                 'owner\accountController@editBase');
            Route::post('/owner/account/base/update',               'owner\accountController@updateBase');
        });

    });

});
