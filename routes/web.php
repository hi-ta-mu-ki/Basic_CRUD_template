<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Db_testController;
use App\Http\Controllers\Db_sampleController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(Db_testController::class)->group(function(){
  Route::group(['prefix' => 'db_test'], function () {
    Route::get('csv_import', 'csv_import'); //表示
    Route::post('csv_import', 'upload_regist'); //登録
  });
});

Route::controller(Db_sampleController::class)->group(function(){
  Route::group(['prefix' => 'db_sample'], function () {
    Route::group(['middleware' => 'auth_admin'], function(){ //admin権限
      Route::get('home_admin', 'home_admin'); //adminホーム
      Route::get('a_list', 'a_list'); //A_masterリスト
      Route::get('a_new', 'a_new'); //A_master新規入力
      Route::patch('a_new', 'a_new_confirm'); //A_master新規確認
      Route::post('a_new', 'a_new_finish'); //A_master新規完了
      Route::get('a_edit/{id?}', 'a_edit'); //A_master編集
      Route::patch('a_edit/{id?}', 'a_edit_confirm'); //A_master編集確認
      Route::post('a_edit/{id?}', 'a_edit_finish'); //A_master編集完了
      Route::get('a_detail/{id?}/', 'a_detail'); //A_master詳細
      Route::post('a_delete/{id?}/', 'a_delete'); //A_master削除
      Route::get('user_list', 'user_list'); //ユーザリスト
      Route::get('user_new', 'user_new'); //ユーザ新規入力
      Route::patch('user_new', 'user_new_confirm'); //ユーザ新規確認
      Route::post('user_new', 'user_new_finish'); //ユーザ新規完了
      Route::get('user_edit/{id?}', 'user_edit'); //ユーザ編集
      Route::patch('user_edit/{id?}', 'user_edit_confirm'); //ユーザ編集確認
      Route::post('user_edit/{id?}', 'user_edit_finish'); //ユーザ編集完了
      Route::post('user_delete/{id?}/', 'user_delete'); //ユーザ削除
    });
    Route::group(['middleware' => 'auth_member'], function(){ //member権限
      Route::get('b_list', 'b_list'); //B_masterリスト
      Route::get('b_new', 'b_new'); //B_master新規入力
      Route::patch('b_new', 'b_new_confirm'); //B_master新規確認
      Route::post('b_new', 'b_new_finish'); //B_master新規完了
      Route::get('b_edit/{id?}', 'b_edit'); //B_master編集
      Route::patch('b_edit/{id?}', 'b_edit_confirm'); //B_master編集確認
      Route::post('b_edit/{id?}', 'b_edit_finish'); //B_master編集完了
      Route::get('b_detail/{id?}/', 'b_detail'); //B_master詳細
      Route::post('b_delete/{id?}/', 'b_delete'); //B_master削除
      Route::get('o_new_list', 'o_new_list'); //o1_transaction入力用B_masterリスト
      Route::get('o_new/{id?}', 'o_new'); //o2_transaction新規入力
      Route::patch('o_new/{id?}', 'o_new_confirm'); //o2_transaction新規確認
      Route::post('o_new/{id?}', 'o_new_finish'); //o2_transaction新規完了
      Route::get('o_list', 'o_list'); //o1_transactionリスト
      Route::get('o_detail/{id?}/', 'o_detail'); //o2_transaction詳細
      Route::get('o_edit/{id1?}/{id2?}', 'o_edit'); //o2_transaction編集
      Route::patch('o_edit/{id1?}/{id2?}', 'o_edit_confirm'); //o2_transaction編集確認
      Route::post('o_edit/{id1?}/{id2?}', 'o_edit_finish'); //o2_transaction編集完了
      Route::post('o1_delete/{id?}/', 'o1_delete'); //o1_ransaction削除
      Route::post('o2_delete/{id?}/', 'o2_delete'); //o2_transaction削除
      Route::get('o_new2/{id?}', 'o_new2'); //o2_transaction新規追加入力
      Route::patch('o_new2/{id?}', 'o_new2_confirm'); //o2_transaction新規追加確認
      Route::post('o_new2/{id?}', 'o_new2_finish'); //o2_transaction新規追加完了
    });
    Route::post('login', 'login_post'); //認証
    Route::get('logout', 'logout'); //認証
  });
});
// ログイン
// Route::get('db_sample/login', function () {
//   return view('db_sample.login');
// });

Route::get('db_sample/login', [Db_sampleController::class, 'login']);