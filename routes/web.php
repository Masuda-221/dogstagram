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



Route::group(['prefix' => 'admin','middleware' => 'auth'], function() {
    Route::get('dogs/create', 'Admin\DogsController@add');
    Route::post('dogs/create', 'Admin\DogsController@create');
    Route::get('dogs/create_profile','Admin\DogsController@profile_add');
    Route::post('dogs/create_profile','Admin\DogsController@create_profile');
    //  Route::get('dogs/serch','Admin\DogsController@serch')
    // けしたい！↓
    //  Route::get('dogs','Admin\DogsController@index')
    //プロフィール編集画面
    Route::get('/dogs/edit', 'Admin\DogsController@edit');
    //プロフィール更新画面
    Route::post('/dogs/edit', 'Admin\DogsController@update');
    //　いいね機能の実装
    Route::get('dogs/mypage', 'Admin\DogsController@mypage');
    // 投稿の削除機能
    Route::post('postsdelete/{post_id}', 'Admin\DogsController@postsdestroy');
    
    // mypageに変更した
    Route::get('dogs/mycontents/{user_id}', 'Admin\DogsController@mycontents');
    Route::get('dogs/mycontents_edit', 'Admin\DogsController@mycontents_edit');
    Route::post('dogs/mycontents_edit', 'Admin\DogsController@mycontents_update');
    
    // フォロー中のユーザー達が投稿した記事一覧
    Route::get('dogs/following_user', 'Admin\DogsController@following_user');
    
    });
     
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// トップページ（検索一覧ページ、views/dogs/index.blade.php）を表示
Route::get('/', 'DogsController@index');
//特定のユーザーの投稿一覧画面
Route::get('dogs/show/{user_id}', 'DogsController@show');
//いいね処理
Route::get('posts/{post_id}/likes', 'LikesController@store')->middleware('auth');
//いいね取消処理
Route::get('likes/{like_id}', 'LikesController@destroy')->middleware('auth');

//コメント投稿
Route::post('posts/{comment_id}/comments', 'CommentsController@commentsstore')->middleware('auth');
//コメント取り消し
Route::get('comments/{comment_id}', 'CommentsController@commentsdestroy')->middleware('auth');

//フォロー機能
Route::group(['prefix' => 'users/{id}'], function () {
    Route::get('followings', 'DogsController@followings')->name('followings');
    Route::get('followers', 'DogsController@followers')->name('followers');
    });
    
Route::group(['prefix' => 'users/{id}'], function () {
    Route::post('follow', 'FollowUserController@store')->name('follow');
    Route::delete('unfollow', 'FollowUserController@destroy')->name('unfollow');
});
    
Route::get('test',function(){
return view('admin.dogs.test');
});