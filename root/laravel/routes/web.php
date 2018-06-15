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

            // 運送会社情報
            Route::get ('/mypage/carrier',                          'mypage\carrierController@showList');
            Route::get ('/mypage/carrier/{carrier_id}',             'mypage\carrierController@showDetail');

            // コンタクトボード
            Route::get ('/mypage/board/carrier/{carrier_id}',       'mypage\boardController@detailByCarrier');
        });


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
