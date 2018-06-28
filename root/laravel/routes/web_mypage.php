<?php

/*
|--------------------------------------------------------------------------
| Web MyPage Routes
|--------------------------------------------------------------------------
*/

// 要ログイン
Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['logined']], function () {

        // MYPAGE = = = = = = = = = = = =
        Route::group(['middleware' => ['mypage']], function () {
            Route::get ('/mypage',                                  'mypage\homeController@dashboard');
            Route::get ('/mypage/dashboard',                        'mypage\homeController@dashboard');

            // 登録状況
            Route::get ('/mypage/status',                           'mypage\homeController@status');

            // アカウント
            Route::get ('/mypage/account',                          'mypage\accountController@showDetail');
            Route::get ('/mypage/account/edit',                     'mypage\accountController@edit');
            Route::post('/mypage/account/update',                   'mypage\accountController@update');
            Route::get ('/mypage/account/email',                    'mypage\accountController@email');
            Route::post('/mypage/account/email',                    'mypage\accountController@sendAuthorizationMail');

            // 住所情報
            Route::get ('/mypage/address',                          'mypage\addressController@showList');
            Route::get ('/mypage/address/{address_id}/detail',      'mypage\addressController@showDetail');
            Route::get ('/mypage/address/create',                   'mypage\addressController@create');
            Route::post('/mypage/address/insert',                   'mypage\addressController@insert');
            Route::get ('/mypage/address/{address_id}/edit',        'mypage\addressController@edit');
            Route::post('/mypage/address/update',                   'mypage\addressController@update');
            Route::get ('/mypage/address/{address_id}/delete',      'mypage\addressController@delete');

            // 荷主として利用開始する
            Route::get ('/mypage/start/owner',                      'mypage\startController@createOwner');
            Route::post('/mypage/start/owner/confirm',              'mypage\startController@confirmOwner');
            Route::post('/mypage/start/owner/execute',              'mypage\startController@executeOwner');
            // 運送会社として利用開始する
            Route::get ('/mypage/start/carrier',                    'mypage\startController@createCarrier');
            Route::post('/mypage/start/carrier/confirm',            'mypage\startController@confirmCarrier');
            Route::post('/mypage/start/carrier/execute',            'mypage\startController@executeCarrier');

            // 運送会社情報
            Route::get ('/mypage/carrier',                          'mypage\carrierController@showList');
            Route::get ('/mypage/carrier/{carrier_id}',             'mypage\carrierController@showDetail');

            // コンタクトボード
            Route::get ('/mypage/board/carrier/{carrier_id}',       'mypage\boardController@detailByCarrier');

            // パスワードリセット完了
            Route::get ('/mypage/password/reset/complete',          'mypage\homeController@passwordReset');
        });

    });

});
