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

    // MYPAGE = = = = = = = = = = = =
    Route::get ('/mypage',                                  'mypage\homeController@dashboard');
    Route::get ('/mypage/dashboard',                        'mypage\homeController@dashboard');

    //   登録状況
     Route::get ('/mypage/status',                           'mypage\homeController@status');

    //   アカウント
    Route::get ('/mypage/account',                          'mypage\accountController@showDetail');
    Route::get ('/mypage/account/edit',                     'mypage\accountController@edit');
    Route::post('/mypage/account/update',                   'mypage\accountController@update');
    Route::get ('/mypage/account/email',                    'mypage\accountController@email');
    Route::post('/mypage/account/email',                    'mypage\accountController@sendAuthorizationMail');

    //   住所情報
    Route::get ('/mypage/address',                          'mypage\addressController@showList');
    Route::get ('/mypage/address/{address_id}/detail',      'mypage\addressController@showDetail');
    Route::get ('/mypage/address/create',                   'mypage\addressController@create');
    Route::post('/mypage/address/insert',                   'mypage\addressController@insert');
    Route::get ('/mypage/address/{address_id}/edit',        'mypage\addressController@edit');
    Route::post('/mypage/address/update',                   'mypage\addressController@update');
    Route::get ('/mypage/address/{address_id}/delete',      'mypage\addressController@delete');

    // ADMIN = = = = = = = = = = = =
    Route::get ('/admin',                                   'admin\homeController@dashboard');
    Route::get ('/admin/dashboard',                         'admin\homeController@dashboard');

    //   更新情報
    Route::get ('/admin/news',                              'admin\newsController@showList');
    Route::get ('/admin/news/{news_id}/detail',             'admin\newsController@showDetail');
    Route::get ('/admin/news/create',                       'admin\newsController@create');
    Route::post('/admin/news/insert',                       'admin\newsController@insert');
    Route::get ('/admin/news/{news_id}/edit',               'admin\newsController@edit');
    Route::post('/admin/news/update',                       'admin\newsController@update');
    Route::get ('/admin/news/{news_id}/delete',             'admin\newsController@delete');
    Route::get ('/admin/news/{news_id}/unpublish',          'admin\newsController@unpublish');

    //   ユーザー
    Route::get ('/admin/user',                              'admin\userController@showList');
    Route::get ('/admin/user/{hashed_id}/detail',           'admin\userController@showDetail');
    Route::get ('/admin/user/create',                       'admin\userController@create');
    Route::post('/admin/user/insert',                       'admin\userController@insert');
    Route::get ('/admin/user/{hashed_id}/edit',             'admin\userController@edit');
    Route::post('/admin/user/update',                       'admin\userController@update');
    Route::get ('/admin/user/{hashed_id}/delete',           'admin\userController@delete');
    Route::get ('/admin/user/{hashed_id}/ban',              'admin\userController@ban');

    //   ページメタ
    Route::get ('/admin/pagemeta',                          'admin\pagemetaController@showList');
    Route::get ('/admin/pagemeta/create',                   'admin\pagemetaController@create');
    Route::post('/admin/pagemeta/create',                   'admin\pagemetaController@confirm');
    Route::post('/admin/pagemeta/update',                   'admin\pagemetaController@update');

    //   マスタ：Authority
    Route::get ('/admin/authority',                                 'admin\authorityController@showList');
    Route::get ('/admin/authority/{authority_id}/detail',           'admin\authorityController@showDetail');
    Route::get ('/admin/authority/create',                          'admin\authorityController@create');
    Route::post('/admin/authority/insert',                          'admin\authorityController@insert');
    Route::get ('/admin/authority/{authority_id}/edit',             'admin\authorityController@edit');
    Route::post('/admin/authority/update',                          'admin\authorityController@update');
    Route::get ('/admin/authority/{authority_id}/delete',           'admin\authorityController@delete');
    //   マスタ：CarrierClass
    Route::get ('/admin/carrier_class',                             'admin\carrierClassController@showList');
    Route::get ('/admin/carrier_class/{class_id}/detail',           'admin\carrierClassController@showDetail');
    Route::get ('/admin/carrier_class/create',                      'admin\carrierClassController@create');
    Route::post('/admin/carrier_class/insert',                      'admin\carrierClassController@insert');
    Route::get ('/admin/carrier_class/{class_id}/edit',             'admin\carrierClassController@edit');
    Route::post('/admin/carrier_class/update',                      'admin\carrierClassController@update');
    Route::get ('/admin/carrier_class/{class_id}/delete',           'admin\carrierClassController@delete');
    //   マスタ：OrderStatus
    Route::get ('/admin/order_status',                              'admin\orderStatusController@showList');
    Route::get ('/admin/order_status/{status_id}/detail',           'admin\orderStatusController@showDetail');
    Route::get ('/admin/order_status/create',                       'admin\orderStatusController@create');
    Route::post('/admin/order_status/insert',                       'admin\orderStatusController@insert');
    Route::get ('/admin/order_status/{status_id}/edit',             'admin\orderStatusController@edit');
    Route::post('/admin/order_status/update',                       'admin\orderStatusController@update');
    Route::get ('/admin/order_status/{status_id}/delete',           'admin\orderStatusController@delete');
    //   マスタ：CargoCategory
    Route::get ('/admin/cargo_category',                            'admin\cargoCategoryController@showList');
    Route::get ('/admin/cargo_category/{category_id}/detail',       'admin\cargoCategoryController@showDetail');
    Route::get ('/admin/cargo_category/create',                     'admin\cargoCategoryController@create');
    Route::post('/admin/cargo_category/insert',                     'admin\cargoCategoryController@insert');
    Route::get ('/admin/cargo_category/{category_id}/edit',         'admin\cargoCategoryController@edit');
    Route::post('/admin/cargo_category/update',                     'admin\cargoCategoryController@update');
    Route::get ('/admin/cargo_category/{category_id}/delete',       'admin\cargoCategoryController@delete');
    //   マスタ：CargoName
    Route::get ('/admin/cargo_name',                                'admin\cargoNameController@showList');
    Route::get ('/admin/cargo_name/{name_id}/detail',               'admin\cargoNameController@showDetail');
    Route::get ('/admin/cargo_name/create',                         'admin\cargoNameController@create');
    Route::post('/admin/cargo_name/insert',                         'admin\cargoNameController@insert');
    Route::get ('/admin/cargo_name/{name_id}/edit',                 'admin\cargoNameController@edit');
    Route::post('/admin/cargo_name/update',                         'admin\cargoNameController@update');
    Route::get ('/admin/cargo_name/{name_id}/delete',               'admin\cargoNameController@delete');
    //   マスタ：CargoForm
    Route::get ('/admin/cargo_form',                                'admin\cargoFormController@showList');
    Route::get ('/admin/cargo_form/{form_id}/detail',               'admin\cargoFormController@showDetail');
    Route::get ('/admin/cargo_form/create',                         'admin\cargoFormController@create');
    Route::post('/admin/cargo_form/insert',                         'admin\cargoFormController@insert');
    Route::get ('/admin/cargo_form/{form_id}/edit',                 'admin\cargoFormController@edit');
    Route::post('/admin/cargo_form/update',                         'admin\cargoFormController@update');
    Route::get ('/admin/cargo_form/{form_id}/delete',               'admin\cargoFormController@delete');
    //   マスタ：EvaluationItem
    Route::get ('/admin/evaluation_item',                           'admin\evaluationItemController@showList');
    Route::get ('/admin/evaluation_item/{item_id}/detail',          'admin\evaluationItemController@showDetail');
    Route::get ('/admin/evaluation_item/create',                    'admin\evaluationItemController@create');
    Route::post('/admin/evaluation_item/insert',                    'admin\evaluationItemController@insert');
    Route::get ('/admin/evaluation_item/{item_id}/edit',            'admin\evaluationItemController@edit');
    Route::post('/admin/evaluation_item/update',                    'admin\evaluationItemController@update');
    Route::get ('/admin/evaluation_item/{item_id}/delete',          'admin\evaluationItemController@delete');
    //   マスタ：Pref
    Route::get ('/admin/pref',                                      'admin\prefController@showList');
    Route::get ('/admin/pref/{pref_code}/detail',                   'admin\prefController@showDetail');
    Route::get ('/admin/pref/create',                               'admin\prefController@create');
    Route::post('/admin/pref/insert',                               'admin\prefController@insert');
    Route::get ('/admin/pref/{pref_code}/edit',                     'admin\prefController@edit');
    Route::post('/admin/pref/update',                               'admin\prefController@update');
    Route::get ('/admin/pref/{pref_code}/delete',                   'admin\prefController@delete');

    //   ログ
    Route::get ('/admin/log/{page?}',                       'admin\logController@showList');




});

Route::post('/ajax/upload_file',                            'AjaxController@uploadFile');
//Route::post('/ajax/add_address',                            'AjaxController@addAddress');

//Route::get ('/cron/run', 'cronController@logWeather');
