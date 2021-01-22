<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\User;
use App\Profile;
use App\FollowUser;
use Auth;
use Storage;

class DogsController extends Controller
{
    public function add()
    {
        $tags = Tag::all();
        
        return view('admin.dogs.create',['tags'=> $tags]);
    }
  
    public function create(Request $request)
    {
        // Varidationを行う
        $this->validate($request, Post::$rules);
        // Post
        $post = new Post;
        // $tag= new Tag;
        $form = $request->all();
        
        // storeというメソッドで保存、$pathに画像のフルパスが入る
        // $path = $request->file('image')->store('public/image');
        $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
        
        //　basenameでフルパスからファイル名だけ取り出す
        // $post->image_path = basename($path);
        $post->image_path = Storage::disk('s3')->url($path);
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);
        // 
        unset($form['tags']);
        
        // データベースに保存する
        $post->fill($form);
        // ログイン中のユーザーのidをpostのuser_idに保存する
        $post->user_id=Auth::id();
        $post->save();
        
        // タグがチェックされていれば保存する
        if (isset($request->tags) && 0 < count($request->tags)) {
            foreach($request->tags as $tagid) {
                $post->tags()->attach($tagid);
            }
        }
        
        return redirect('admin/dogs/mypage');
    }
  
    public function profile_add()
    {
        return view('admin.dogs.create_profile');
    }
    
    // プロフィールを新規作成
    public function create_profile(Request $request)
    {
        // validation(入力チェックエラー）
        $this ->validate($request,Profile::$rules);
        
        $profile = new profile;
        $form = $request->all();
        
        unset($form['_token']);
        // データベースに保存する
        $path = $request->file('image')->store('public/image');
        
        //　basenameでフルパスからファイル名だけ取り出す
        $profile->image = basename($path);
        unset($form['image']); 
        $profile->fill($form);
        // 現在ログインしているユーザーの情報が取れる
        $profile->user_id = Auth::id();
        $profile->save();
        
        return redirect('admin/dogs/mypage');
    }
    
    //プロフィールを編集
    public function edit(Request $request)
    {
        // Profileモデルからデータを取得する
        $profile = Profile::find($request->id);
        if (empty($profile)) {
        abort(404);    
        }
        
        return view('admin.dogs.edit', ['profile' => $profile, 'user' => Auth::user()]);
    }
    
    
    public function update(Request $request)
    {
        // validate をかける
        $this -> validate($request, Profile::$rules);
        // Profileモデルからデータを取得する
        $profile = Profile::find($request->id);
        // 送信されてきたフォームデータを格納する
        $form = $request->all();
        
        $path = $request->file('image')->store('public/image');
        
        //　basenameでフルパスからファイル名だけ取り出す
        $profile->image = basename($path);
        unset($form['_token']);
        unset($form['image']);
        
        // 該当するデータを上書きして保存する
        $profile ->fill($form)->save();
        
        return redirect('admin/dogs/mypage');
        
    }
    
    // //投稿したコンテンツ一覧を表示
    // public function mycontents(Request $request)
    // {
    //     $profile = Profile::find($request->id);
        
    //     return view('admin.dogs.mycontents', ['user' => Auth::user(),'profile',$profile]);
    // }
    
    //投稿したコンテンツを更新
    public function mycontents_edit(Request $request)
    {
        //Post Modelからデータを取得する
        $posts = Post::find($request->id);
        if (empty($posts)) {
            // 「ページが見つかりません」エラー
            abort(404);
        }
        $tags = Tag::all();
        
        return view('admin.dogs.mycontents_edit',['posts'=>$posts,'tags' => $tags]);
    }
    
    //投稿したコンテンツを上書き
    public function mycontents_update(Request $request)
    {
        // Varidationを行う
        $this->validate($request, Post::$rules);
        //PostModelからコンテンツを取得
        $post = Post::find($request->id);
        //送信されてきたフォームデータを格納する
        $form = $request->all();
        
        if ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $form['image_path'] = basename($path);
        } else {
            $form['image_path'] = $post->image_path;
        }
      
        unset($form['_token']);
        unset($form['image']);
        unset($form['tags']);
        
        $post->fill($form)->save();
        
        if (isset($request->tags) && 0 < count($request->tags)){
            $post->tags()->detach();
            
            foreach($request->tags as $tagid) {
                $post->tags()->attach($tagid);
            }
        }
        
        return redirect('admin/dogs/mypage');
    }
    
    public function mypage()
    {
        $user = Auth::user();
        $count_followings = $user->followings()->count();
        $count_followers = $user->followers()->count();
         
        return view('admin.dogs.mypage', ['user' => $user,'count_followings' => $count_followings,'count_followers' => $count_followers]);
    }
    
    //投稿の削除機能
    public function postsdestroy($post_id)
    {
        $post = Post::find($post_id);
        $post->delete();
        
        return redirect('admin/dogs/mypage');
    }
    
    public function following_user()
    {
        $user = Auth::user();
        $post = Auth::user()->followings;
        
        return view('admin.dogs.following_user', ['user' => $user,'post'=>$post]);
    }
}
