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

// ユーザー登録
  // メアド入力
Route::get ('/signup',                          'common\signupController@email');
Route::post('/signup',                          'common\signupController@sendSignupMail');
  // ログイン情報設定
Route::get ('/signup/{signup_key}/create',      'common\signupController@create');
Route::post('/signup/insert',                   'common\signupController@insert');
  // 住所氏名・種別選択
Route::get ('/signup/{signup_key}/edit',        'common\signupController@edit');
Route::post('/signup/update',                   'common\signupController@update');
  // 同意事項＆ 確定 or 決済登録へのリンク
Route::get ('/signup/{signup_key}/accept',      'common\signupController@accept');
Route::get ('/signup/{signup_key}/accepted',    'common\signupController@accepted');

  // 取引情報送信処理: イプシロンからデータを受け取る／イプシロンにデータを送る
Route::post('/epsilon/entry',                   'common\epsilonController@entry');
  // 取引登録エラー: イプシロンからデータを受け取る／イプシロンにデータを送る
Route::post('/epsilon/error',                   'common\epsilonController@error');
  // 取引結果受信処理: イプシロンからデータを受け取る／イプシロンにデータを送る
Route::post('/epsilon/result',                  'common\epsilonController@result');

  // 完了 flag で決済有無判定・表示切替
Route::get ('/signup/{signup_key}/complete',    'common\signupController@completeOwner');



// メールアドレス変更認証
Route::get ('/authorization/{authorization_code}',          'common\authorizationController@authorization');



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
        });


        // OWNER = = = = = = = = = = = =
        Route::group(['middleware' => ['owner']], function () {
            Route::get ('/owner',                                   'owner\homeController@dashboard');
            Route::get ('/owner/dashboard',                         'owner\homeController@dashboard');

            // 案件
            Route::get ('/owner/order',                             'owner\orderController@showList');
            Route::get ('/owner/order/{order_id}/detail',           'owner\orderController@showDetail');
            Route::get ('/owner/order/create',                      'owner\orderController@create');
            Route::post('/owner/order/confirm',                     'owner\orderController@confirm');
            Route::post('/owner/order/insert',                      'owner\orderController@insert');
            Route::get ('/owner/order/{order_id}/edit',             'owner\orderController@edit');
            Route::post('/owner/order/{order_id}/confirm',          'owner\orderController@confirmUpdate');
            Route::post('/owner/order/update',                      'owner\orderController@update');
            Route::get ('/owner/order/{order_id}/delete',           'owner\orderController@delete');
            Route::get ('/owner/order/{order_id}/duplicate',        'owner\orderController@duplicate');

            // 見積依頼
            Route::get ('/owner/request/{order_id}',                'owner\requestController@create');
            Route::post('/owner/request/confirm',                   'owner\requestController@confirm');
            Route::post('/owner/request/execute',                   'owner\requestController@execute');
            Route::get ('/owner/request/{order_id}/cancel',         'owner\requestController@cancel');
        });

        // CARRIER = = = = = = = = = = = =
        Route::group(['middleware' => ['carrier']], function () {
            Route::get ('/carrier',                                 'carrier\homeController@dashboard');
            Route::get ('/carrier/dashboard',                       'carrier\homeController@dashboard');

            // 見積依頼
            Route::get ('/carrier/request',                         'carrier\requestController@showList');
            Route::get ('/carrier/request/{order_id}/detail',       'carrier\requestController@showDetail');

            // 見積作成
            Route::get ('/carrier/estimate/{order_id}/create',      'carrier\estimateController@create');
            Route::post('/carrier/estimate/confirm',                'carrier\estimateController@confirm');
            Route::post('/carrier/estimate/insert',                 'carrier\estimateController@insert');

            // 見積用商品
            Route::get ('/carrier/item',                            'carrier\itemController@showList');
            Route::get ('/carrier/item/{item_id}/detail',           'carrier\itemController@showDetail');
            Route::get ('/carrier/item/create',                     'carrier\itemController@create');
            Route::post('/carrier/item/insert',                     'carrier\itemController@insert');
            Route::get ('/carrier/item/{item_id}/edit',             'carrier\itemController@edit');
            Route::post('/carrier/item/update',                     'carrier\itemController@update');
            Route::get ('/carrier/item/{item_id}/delete',           'carrier\itemController@delete');

            // 案件
            Route::get ('/carrier/work',                                'carrier\workController@showList');
        });

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
            Route::post('/admin/pagemeta/create',                   'admin\pagemetaController@confirm');
            Route::post('/admin/pagemeta/update',                   'admin\pagemetaController@update');

            // マスタ：Authority
            Route::get ('/admin/authority',                                 'admin\authorityController@showList');
            Route::get ('/admin/authority/{authority_id}/detail',           'admin\authorityController@showDetail');
            Route::get ('/admin/authority/create',                          'admin\authorityController@create');
            Route::post('/admin/authority/insert',                          'admin\authorityController@insert');
            Route::get ('/admin/authority/{authority_id}/edit',             'admin\authorityController@edit');
            Route::post('/admin/authority/update',                          'admin\authorityController@update');
            Route::get ('/admin/authority/{authority_id}/delete',           'admin\authorityController@delete');
            // マスタ：CarrierClass
            Route::get ('/admin/carrier_class',                             'admin\carrierClassController@showList');
            Route::get ('/admin/carrier_class/{class_id}/detail',           'admin\carrierClassController@showDetail');
            Route::get ('/admin/carrier_class/create',                      'admin\carrierClassController@create');
            Route::post('/admin/carrier_class/insert',                      'admin\carrierClassController@insert');
            Route::get ('/admin/carrier_class/{class_id}/edit',             'admin\carrierClassController@edit');
            Route::post('/admin/carrier_class/update',                      'admin\carrierClassController@update');
            Route::get ('/admin/carrier_class/{class_id}/delete',           'admin\carrierClassController@delete');
            // マスタ：OrderStatus
            Route::get ('/admin/order_status',                              'admin\orderStatusController@showList');
            Route::get ('/admin/order_status/{status_id}/detail',           'admin\orderStatusController@showDetail');
            Route::get ('/admin/order_status/create',                       'admin\orderStatusController@create');
            Route::post('/admin/order_status/insert',                       'admin\orderStatusController@insert');
            Route::get ('/admin/order_status/{status_id}/edit',             'admin\orderStatusController@edit');
            Route::post('/admin/order_status/update',                       'admin\orderStatusController@update');
            Route::get ('/admin/order_status/{status_id}/delete',           'admin\orderStatusController@delete');
            // マスタ：CargoName
            Route::get ('/admin/cargo_name',                                'admin\cargoNameController@showList');
            Route::get ('/admin/cargo_name/{name_id}/detail',               'admin\cargoNameController@showDetail');
            Route::get ('/admin/cargo_name/create',                         'admin\cargoNameController@create');
            Route::post('/admin/cargo_name/insert',                         'admin\cargoNameController@insert');
            Route::get ('/admin/cargo_name/{name_id}/edit',                 'admin\cargoNameController@edit');
            Route::post('/admin/cargo_name/update',                         'admin\cargoNameController@update');
            Route::get ('/admin/cargo_name/{name_id}/delete',               'admin\cargoNameController@delete');
            // マスタ：CargoForm
            Route::get ('/admin/cargo_form',                                'admin\cargoFormController@showList');
            Route::get ('/admin/cargo_form/{form_id}/detail',               'admin\cargoFormController@showDetail');
            Route::get ('/admin/cargo_form/create',                         'admin\cargoFormController@create');
            Route::post('/admin/cargo_form/insert',                         'admin\cargoFormController@insert');
            Route::get ('/admin/cargo_form/{form_id}/edit',                 'admin\cargoFormController@edit');
            Route::post('/admin/cargo_form/update',                         'admin\cargoFormController@update');
            Route::get ('/admin/cargo_form/{form_id}/delete',               'admin\cargoFormController@delete');
            // マスタ：EvaluationItem
            Route::get ('/admin/evaluation_item',                           'admin\evaluationItemController@showList');
            Route::get ('/admin/evaluation_item/{item_id}/detail',          'admin\evaluationItemController@showDetail');
            Route::get ('/admin/evaluation_item/create',                    'admin\evaluationItemController@create');
            Route::post('/admin/evaluation_item/insert',                    'admin\evaluationItemController@insert');
            Route::get ('/admin/evaluation_item/{item_id}/edit',            'admin\evaluationItemController@edit');
            Route::post('/admin/evaluation_item/update',                    'admin\evaluationItemController@update');
            Route::get ('/admin/evaluation_item/{item_id}/delete',          'admin\evaluationItemController@delete');
            // マスタ：Pref
            Route::get ('/admin/pref',                                      'admin\prefController@showList');
            Route::get ('/admin/pref/{pref_code}/detail',                   'admin\prefController@showDetail');
            Route::get ('/admin/pref/create',                               'admin\prefController@create');
            Route::post('/admin/pref/insert',                               'admin\prefController@insert');
            Route::get ('/admin/pref/{pref_code}/edit',                     'admin\prefController@edit');
            Route::post('/admin/pref/update',                               'admin\prefController@update');
            Route::get ('/admin/pref/{pref_code}/delete',                   'admin\prefController@delete');

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

Route::post('/ajax/upload_file',                            'AjaxController@uploadFile');
Route::post('/ajax/quote_user_account',                     'AjaxController@quoteUserAccount');
Route::post('/ajax/quote_address',                          'AjaxController@quoteAddress');
Route::post('/ajax/add_estimate_item',                      'AjaxController@addEstimateItem');
Route::post('/ajax/quote_item',                             'AjaxController@quoteItem');
Route::post('/ajax/quote_order',                            'AjaxController@quoteOrder');
//Route::post('/ajax/add_estimate_item',                      'AjaxController@addEstimateItem');

//Route::get ('/cron/run', 'cronController@logWeather');
