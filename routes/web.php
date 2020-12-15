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




// 謎の記述、消してもいいか？
// Route::post('/', function () {
//     $post = new App\Post();
//     $post->image = request()->image;
//     $post->body = request()->body;
//     $post->pref = request()->pref;
//     $post->city = request()->city;
//     $post->place = request()->placey;
//     $post->save();
//     $post->tags()->attach(request()->tags);
//     return redirect('/');
// });

// Route::get('/',function(){
//     return view('admin.dogs.create',['posts'=>App\Post::all(),'tags'=>App\Tag::all()]);
// });

     Route::group(['prefix' => 'admin'], function() {
         Route::get('dogs/create', 'Admin\DogsController@add')->middleware('auth');
         Route::post('dogs/create', 'Admin\DogsController@create')->middleware('auth');
         Route::get('dogs/create_profile','Admin\DogsController@profile_add')->middleware('auth');
         Route::post('dogs/create_profile','Admin\DogsController@create_profile')->middleware('auth');
         Route::get('dogs/serch','Admin\DogsController@serch')->middleware('auth');
         Route::get('dogs','Admin\DogsController@index')->middleware('auth');
         //プロフィール編集画面
         Route::get('/dogs/edit', 'Admin\DogsController@edit');
         //プロフィール更新画面
         Route::post('/dogs/edit', 'Admin\DogsController@update');
         //特定のユーザーの投稿一覧画面
         Route::get('dogs/show/{user_id}', 'Admin\DogsController@show')->middleware('auth');
         // mypageに変更した
         Route::get('dogs/mycontents/{user_id}', 'Admin\DogsController@mycontents')->middleware('auth');
         //投稿したニュースを更新/削除
         Route::get('dogs/mycontents_edit', 'Admin\DogsController@mycontents_edit')->middleware('auth');
         Route::post('dogs/mycontents_edit', 'Admin\DogsController@mycontents_update')->middleware('auth');
         Route::get('dogs/mypage', 'Admin\DogsController@mypage')->middleware('auth');
     });
     
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// トップページ（検索一覧ページ、dogs/index.blade.php）を表示
Route::get('/', 'DogsController@index');

Route::get('test',function(){
return view('admin.dogs.test');
});