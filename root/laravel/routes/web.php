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
/*
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
*/

Route::get ('/', 'HomeController@index');
Auth::routes();

Route::group(['middleware' => ['auth']], function () {


    // MYPAGE = = = = = = = = = = = =
    Route::get ('/mypage',                                  'mypage\homeController@dashboard');
    Route::get ('/mypage/dashboard',                        'mypage\homeController@dashboard');

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

    //   ページメタ
    Route::get ('/admin/pagemeta',                          'admin\pagemetaController@showList');
    Route::get ('/admin/pagemeta/create',                   'admin\pagemetaController@create');
    Route::post('/admin/pagemeta/make',                     'admin\pagemetaController@make');

    //   ログ
    Route::get ('/admin/log/{page?}',                       'admin\logController@showList');




});

Route::post('/ajax/upload_file',                            'AjaxController@uploadFile');

//Route::get ('/cron/run', 'cronController@logWeather');
