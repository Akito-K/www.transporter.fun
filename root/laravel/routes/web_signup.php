<?php

/*
|--------------------------------------------------------------------------
| Web Signup Routes
|--------------------------------------------------------------------------
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

