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

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(Db_testController::class)->group(function(){
  Route::group(['prefix' => 'db_test'], function () {
    Route::get('db_test', 'db_test');
    Route::get('db_test2/{id?}', 'db_test2');
    Route::get('db_test3/{id?}', 'db_test3');
    Route::get('csv_import', 'csv_import'); //表示
    Route::post('csv_import', 'upload_regist'); //登録
  });
});

Route::controller(Db_sampleController::class)->group(function(){
  Route::group(['prefix' => 'db_sample'], function () {
    Route::get('home_admin', 'home_admin'); //ホーム
    Route::get('a_list', 'a_list'); //一覧
    Route::get('a_new', 'a_new'); //入力
    Route::patch('a_new', 'a_new_confirm'); //確認
    Route::post('a_new', 'a_new_finish'); //完了
    Route::get('a_edit/{id?}', 'a_edit'); //編集
    Route::patch('a_edit/{id?}', 'a_edit_confirm'); //確認
    Route::post('a_edit/{id?}', 'a_edit_finish'); //完了
    Route::get('a_detail/{id?}/', 'a_detail'); // 詳細
    Route::post('a_delete/{id?}/', 'a_delete'); //削除
    Route::get('b_list', 'b_list'); //一覧
    Route::get('b_new', 'b_new'); //入力
    Route::patch('b_new', 'b_new_confirm'); //確認
    Route::post('b_new', 'b_new_finish'); //完了
    Route::get('b_edit/{id?}', 'b_edit'); //編集
    Route::patch('b_edit/{id?}', 'b_edit_confirm'); //確認
    Route::post('b_edit/{id?}', 'b_edit_finish'); //完了
    Route::get('b_detail/{id?}/', 'b_detail'); // 詳細
    Route::post('b_delete/{id?}/', 'b_delete'); //削除
    Route::get('user_list', 'user_list'); //一覧
    Route::get('user_new', 'user_new'); //入力
    Route::patch('user_new', 'user_new_confirm'); //確認
    Route::post('user_new', 'user_new_finish'); //完了
    Route::get('user_edit/{id?}', 'user_edit'); //編集
    Route::patch('user_edit/{id?}', 'user_edit_confirm'); //確認
    Route::post('user_edit/{id?}', 'user_edit_finish'); //完了
    Route::post('user_delete/{id?}/', 'user_delete'); //削除
    Route::get('o_list', 'o_list'); //一覧
    Route::get('o_b_new/{id?}', 'o_b_new'); //入力
    Route::get('o_new/{id?}', 'o_new'); //入力
    Route::patch('o_new/{id?}', 'o_new_confirm'); //確認
    Route::post('o_new/{id?}', 'o_new_finish'); //完了
    Route::get('o_edit/{id?}', 'o_edit'); //編集
    Route::patch('o_edit/{id?}', 'o_edit_confirm'); //確認
    Route::post('o_edit/{id?}', 'o_edit_finish'); //完了
    Route::get('o_detail/{id?}/', 'o_detail'); // 詳細
    Route::post('o1_delete/{id?}/', 'o1_delete'); //削除
    Route::post('o2_delete/{id?}/', 'o2_delete'); //削除
    Route::get('o_new_b_list', 'o_new_b_list'); //一覧
  });
});
