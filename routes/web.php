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

// Route::get('/', function () {
//     return view('welcome');
// });

// メインページ
Route::get('/', 'PostController@index')->name('top');

// ログイン関連
Auth::routes();

// ユーザープロフィール関連
// プロフィール
Route::resource('users', 'UserController')->only([
  'show',
]);
// プロフィール編集
Route::get('/users/edit/{user}', 'UserController@edit')->name('users.edit');
Route::patch('/users', 'UserController@update')->name('users.update');
// プロフィール画像編集
Route::get('/users/edit_image/{user}', 'UserController@editImage')->name('users.edit_image');
Route::patch('/users/edit_image/{user}', 'UserController@updateImage')->name('users.update_image');

// 出品商品
Route::get('/users/{user}/exhibitios', 'UserController@exhibitios')->name('users.exhibitios');

// 商品をお気に入り
Route::resource('likes', 'LikeController')->only([
  'index', 'store', 'destroy'
]);

// 商品関連
Route::get('/items/index', 'ItemController@index')->name('items.index');
// 新規出品
Route::get('/items/create', 'ItemController@create')->name('items.create');
Route::post('/items/create', 'ItemController@store')->name('items.store');
// 商品詳細
Route::get('/items/{item}', 'ItemController@show')->name('items.show');
// 出品商品更新
Route::get('/items/edit/{item}', 'ItemController@edit')->name('items.edit');
Route::PATCH('/items/edit/{item}', 'ItemController@update')->name('items.update');
// 出品画像更新
Route::get('/items/edit_image/{item}', 'ItemController@editImage')->name('items.edit_image');
Route::PATCH('/items/edit_image/{item}', 'ItemController@updateImage')->name('items.update_image');
// 出品商品削除
Route::delete('items/{item}', 'ItemController@destroy')->name('items.destroy');

// 購入確認
Route::post('items/confirm/{item}', 'ItemController@confirm')->name('items.confirm');
// 購入確定
Route::post('items/finish/{item}', 'ItemController@finish')->name('items.finish');

Route::patch('/items/toggle_like/{item}', 'ItemController@toggleLike')->name('items.toggle_like');