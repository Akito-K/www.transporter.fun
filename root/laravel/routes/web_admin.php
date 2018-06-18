<?php

/*
|--------------------------------------------------------------------------
| Web Admin Routes
|--------------------------------------------------------------------------
*/

// 要ログイン
Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['logined']], function () {

        // ADMIN = = = = = = = = = = = =
        Route::group(['middleware' => ['adminAuth']], function () {

            Route::get ('/admin',                                   'admin\homeController@dashboard');
            Route::get ('/admin/dashboard',                         'admin\homeController@dashboard');

            // 更新情報
            Route::get ('/admin/news',                              'admin\newsController@showList');
            Route::get ('/admin/news/{news_id}/detail',             'admin\newsController@showDetail');
            Route::get ('/admin/news/create',                       'admin\newsController@create');
            Route::post('/admin/news/insert',                       'admin\newsController@insert');
            Route::get ('/admin/news/{news_id}/edit',               'admin\newsController@edit');
            Route::post('/admin/news/update',                       'admin\newsController@update');
            Route::get ('/admin/news/{news_id}/delete',             'admin\newsController@delete');
            Route::get ('/admin/news/{news_id}/unpublish',          'admin\newsController@unpublish');

            // ユーザー
            Route::get ('/admin/user',                              'admin\userController@showList');
            Route::get ('/admin/user/{hashed_id}/detail',           'admin\userController@showDetail');
            Route::get ('/admin/user/create',                       'admin\userController@create');
            Route::post('/admin/user/insert',                       'admin\userController@insert');
            Route::get ('/admin/user/{hashed_id}/edit',             'admin\userController@edit');
            Route::post('/admin/user/update',                       'admin\userController@update');
            Route::get ('/admin/user/{hashed_id}/delete',           'admin\userController@delete');
            Route::get ('/admin/user/{hashed_id}/ban',              'admin\userController@ban');

            // ページメタ
            Route::get ('/admin/pagemeta',                          'admin\pagemetaController@showList');
            Route::get ('/admin/pagemeta/create',                   'admin\pagemetaController@create');
            Route::post('/admin/pagemeta/confirm',                  'admin\pagemetaController@confirm');
            Route::post('/admin/pagemeta/update',                   'admin\pagemetaController@update');

            // マスタ：Authority
            Route::get ('/admin/authority',                                 'admin\authorityController@showList');
            Route::get ('/admin/authority/create',                          'admin\authorityController@create');
            Route::post('/admin/authority/insert',                          'admin\authorityController@insert');
            Route::get ('/admin/authority/{authority_id}/edit',             'admin\authorityController@edit');
            Route::post('/admin/authority/update',                          'admin\authorityController@update');
            Route::get ('/admin/authority/{authority_id}/delete',           'admin\authorityController@delete');
            // マスタ：CarrierClass
            Route::get ('/admin/carrier_class',                             'admin\carrierClassController@showList');
            Route::get ('/admin/carrier_class/create',                      'admin\carrierClassController@create');
            Route::post('/admin/carrier_class/insert',                      'admin\carrierClassController@insert');
            Route::get ('/admin/carrier_class/{class_id}/edit',             'admin\carrierClassController@edit');
            Route::post('/admin/carrier_class/update',                      'admin\carrierClassController@update');
            Route::get ('/admin/carrier_class/{class_id}/delete',           'admin\carrierClassController@delete');
            // マスタ：Status
            Route::get ('/admin/status',                                    'admin\statusController@showList');
            // マスタ：CargoName
            Route::get ('/admin/cargo_name',                                'admin\cargoNameController@showList');
            Route::get ('/admin/cargo_name/create',                         'admin\cargoNameController@create');
            Route::post('/admin/cargo_name/insert',                         'admin\cargoNameController@insert');
            Route::get ('/admin/cargo_name/{name_id}/edit',                 'admin\cargoNameController@edit');
            Route::post('/admin/cargo_name/update',                         'admin\cargoNameController@update');
            Route::get ('/admin/cargo_name/{name_id}/delete',               'admin\cargoNameController@delete');
            // マスタ：CargoForm
            Route::get ('/admin/cargo_form',                                'admin\cargoFormController@showList');
            Route::get ('/admin/cargo_form/create',                         'admin\cargoFormController@create');
            Route::post('/admin/cargo_form/insert',                         'admin\cargoFormController@insert');
            Route::get ('/admin/cargo_form/{form_id}/edit',                 'admin\cargoFormController@edit');
            Route::post('/admin/cargo_form/update',                         'admin\cargoFormController@update');
            Route::get ('/admin/cargo_form/{form_id}/delete',               'admin\cargoFormController@delete');
            // マスタ：EvaluationItem
            Route::get ('/admin/evaluation_item',                           'admin\evaluationItemController@showList');
            Route::get ('/admin/evaluation_item/create',                    'admin\evaluationItemController@create');
            Route::post('/admin/evaluation_item/insert',                    'admin\evaluationItemController@insert');
            Route::get ('/admin/evaluation_item/{item_id}/edit',            'admin\evaluationItemController@edit');
            Route::post('/admin/evaluation_item/update',                    'admin\evaluationItemController@update');
            Route::get ('/admin/evaluation_item/{item_id}/delete',          'admin\evaluationItemController@delete');
            // マスタ：Pref
            Route::get ('/admin/pref',                                      'admin\prefController@showList');
            // 案件登録オプション：希望車種
            Route::get ('/admin/order_request_option/car',                              'admin\orderRequestOptionController@showCarList');
            Route::get ('/admin/order_request_option/car/create',                       'admin\orderRequestOptionController@createCar');
            Route::post('/admin/order_request_option/car/insert',                       'admin\orderRequestOptionController@insertCar');
            Route::get ('/admin/order_request_option/car/{option_id}/edit',             'admin\orderRequestOptionController@editCar');
            Route::post('/admin/order_request_option/car/update',                       'admin\orderRequestOptionController@updateCar');
            Route::get ('/admin/order_request_option/car/{option_id}/delete',           'admin\orderRequestOptionController@deleteCar');
            // 案件登録オプション：希望設備
            Route::get ('/admin/order_request_option/equipment',                        'admin\orderRequestOptionController@showEquipmentList');
            Route::get ('/admin/order_request_option/equipment/create',                 'admin\orderRequestOptionController@createEquipment');
            Route::post('/admin/order_request_option/equipment/insert',                 'admin\orderRequestOptionController@insertEquipment');
            Route::get ('/admin/order_request_option/equipment/{option_id}/edit',       'admin\orderRequestOptionController@editEquipment');
            Route::post('/admin/order_request_option/equipment/update',                 'admin\orderRequestOptionController@updateEquipment');
            Route::get ('/admin/order_request_option/equipment/{option_id}/delete',     'admin\orderRequestOptionController@deleteEquipment');
            // 案件登録オプション：希望装備
            Route::get ('/admin/order_request_option/other',                            'admin\orderRequestOptionController@showOtherList');
            Route::get ('/admin/order_request_option/other/create',                     'admin\orderRequestOptionController@createOther');
            Route::post('/admin/order_request_option/other/insert',                     'admin\orderRequestOptionController@insertOther');
            Route::get ('/admin/order_request_option/other/{option_id}/edit',           'admin\orderRequestOptionController@editOther');
            Route::post('/admin/order_request_option/other/update',                     'admin\orderRequestOptionController@updateOther');
            Route::get ('/admin/order_request_option/other/{option_id}/delete',         'admin\orderRequestOptionController@deleteOther');

            // ログ
            Route::get ('/admin/log/{page?}',                       'admin\logController@showList');
        });
    });

});
