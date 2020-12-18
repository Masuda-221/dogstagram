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
         //特定のユーザーの投稿一覧画面
         
         // mypageに変更した
         Route::get('dogs/mycontents/{user_id}', 'Admin\DogsController@mycontents');
         Route::get('dogs/mycontents_edit', 'Admin\DogsController@mycontents_edit');
         Route::post('dogs/mycontents_edit', 'Admin\DogsController@mycontents_update');
         Route::get('dogs/mypage', 'Admin\DogsController@mypage');
     });
     
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// トップページ（検索一覧ページ、dogs/index.blade.php）を表示
Route::get('/', 'DogsController@index');
Route::get('dogs/show/{user_id}', 'DogsController@show');

Route::get('test',function(){
return view('admin.dogs.test');
});