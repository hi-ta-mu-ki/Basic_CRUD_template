<?php

use Illuminate\Support\Facades\Route;

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

Route::get('db_test/db_test', [App\Http\Controllers\Db_testController::class, 'db_test']);
Route::get('db_test/db_test2/{id?}', [App\Http\Controllers\Db_testController::class, 'db_test2']);
Route::get('db_test/db_test3/{id?}', [App\Http\Controllers\Db_testController::class, 'db_test3']);
Route::get('db_test/csv_import', [App\Http\Controllers\Db_testController::class, 'csv_import']); //表示
Route::post('db_test/csv_import', [App\Http\Controllers\Db_testController::class, 'upload_regist']); //登録

Route::group(['prefix' => 'db_sample'], function () {
  Route::get('home_admin', [App\Http\Controllers\Db_sampleController::class, 'home_admin']); //ホーム
  Route::get('a_list', [App\Http\Controllers\Db_sampleController::class, 'a_list']); //一覧
  Route::get('a_new', [App\Http\Controllers\Db_sampleController::class, 'a_new']); //入力
  Route::patch('a_new',[App\Http\Controllers\Db_sampleController::class, 'a_new_confirm']); //確認
  Route::post('a_new', [App\Http\Controllers\Db_sampleController::class, 'a_ew_finish']); //完了
  Route::get('a_edit/{id?}', [App\Http\Controllers\Db_sampleController::class, 'a_edit']); //編集
  Route::patch('a_edit/{id?}',[App\Http\Controllers\Db_sampleController::class, 'a_edit_confirm']); //確認
  Route::post('a_edit/{id?}', [App\Http\Controllers\Db_sampleController::class, 'a_edit_finish']); //完了
  Route::get('a_detail/{id?}/', [App\Http\Controllers\Db_sampleController::class, 'a_detail']); // 詳細
  Route::post('a_delete/{id?}/', [App\Http\Controllers\Db_sampleController::class, 'a_delete']); //削除
  Route::get('b_list', [App\Http\Controllers\Db_sampleController::class, 'b_list']); //一覧
  Route::get('b_new', [App\Http\Controllers\Db_sampleController::class, 'b_new']); //入力
  Route::patch('b_new',[App\Http\Controllers\Db_sampleController::class, 'b_new_confirm']); //確認
  Route::post('b_new', [App\Http\Controllers\Db_sampleController::class, 'b_ew_finish']); //完了
  Route::get('b_edit/{id?}', [App\Http\Controllers\Db_sampleController::class, 'b_edit']); //編集
  Route::patch('b_edit/{id?}',[App\Http\Controllers\Db_sampleController::class, 'b_edit_confirm']); //確認
  Route::post('b_edit/{id?}', [App\Http\Controllers\Db_sampleController::class, 'b_edit_finish']); //完了
  Route::get('b_detail/{id?}/', [App\Http\Controllers\Db_sampleController::class, 'b_detail']); // 詳細
  Route::post('b_delete/{id?}/', [App\Http\Controllers\Db_sampleController::class, 'b_delete']); //削除
  Route::get('user_list', [App\Http\Controllers\Db_sampleController::class, 'user_list']); //一覧
  Route::get('user_new', [App\Http\Controllers\Db_sampleController::class, 'user_new']); //入力
  Route::patch('user_new',[App\Http\Controllers\Db_sampleController::class, 'user_new_confirm']); //確認
  Route::post('user_new', [App\Http\Controllers\Db_sampleController::class, 'user_new_finish']); //完了
  Route::get('user_edit/{id?}', [App\Http\Controllers\Db_sampleController::class, 'user_edit']); //編集
  Route::patch('user_edit/{id?}',[App\Http\Controllers\Db_sampleController::class, 'user_edit_confirm']); //確認
  Route::post('user_edit/{id?}', [App\Http\Controllers\Db_sampleController::class, 'user_edit_finish']); //完了
  Route::post('user_delete/{id?}/', [App\Http\Controllers\Db_sampleController::class, 'user_delete']); //削除
});

Route::group(['prefix' => 'db_sample'], function () {
  Route::get('list', [App\Http\Controllers\Db_sampleController::class, 'list']); //一覧
  Route::get('detail/{id?}/', [App\Http\Controllers\Db_sampleController::class, 'detail']); // 詳細
});
