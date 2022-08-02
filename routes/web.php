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
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout');//ログアウトルーティング

//新規ユーザー登録のルーティング
Route::get('/register', 'Auth\RegisterController@register');//get通信の場合がこのルーティングが行われる
Route::post('/register', 'Auth\RegisterController@register');//post通信の場合がこのルーティングが行われる

Route::get('/added', 'Auth\RegisterController@added');


//ログイン中のページ
Route::get('/top','PostsController@index');

//投稿機能のルーティング URL'posts/create'から値が来た時 PostsControllerのcreateメソッドを実行する
Route::post('posts/create','PostsController@create');

//更新機能のルーティング
Route::post('/post/update','PostsController@update');

//削除機能のルーティング
Route::get('/post/{id}/delete','PostsController@delete');

//マイページ更新のルーティング
Route::get('/profile','UsersController@profile');
Route::post('/profile','UsersController@profile');

//検索のルーティング
Route::get('/search','UsersController@search');//get送信の時
Route::post('/search','UsersController@search');//post送信の時

//フォローする フォローを外す
Route::get('/follow/{id}','FollowsController@follow');
Route::get('/unfollow/{id}','FollowsController@unfollow');

//フォローリスト表示 フォロワーリスト表示
Route::get('/followList','FollowsController@followList');
Route::get('/followerList','FollowsController@followerList');

//フォローしている人のプロフィール表示
Route::get('/followProfile/{id}','FollowsController@followProfile');
Route::post('/followProfile','FollowsController@followProfile');

Route::get('/followerProfile/{id}','FollowsController@followerProfile');
Route::post('/followerProfile','FollowsController@followerProfile');

// ランキング
Route::get('/ranking','RankingController@index');
Route::get('ranking/daily','RankingController@daily')->name('ranking.daily');
