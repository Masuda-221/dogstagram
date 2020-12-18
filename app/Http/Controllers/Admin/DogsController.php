<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\User;
use App\Profile;
use Auth;

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
      
      // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
      
      // storeというメソッドで保存、$pathに画像のフルパスが入る
      $path = $request->file('image')->store('public/image');
      
      //　basenameでフルパスからファイル名だけ取り出す
      $post->image_path = basename($path);
      
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
  
//  views/dogs/indexのコントローラー App\Http\Controllers\DogsControllerに移行しました
// 投稿された記事の一覧を表示する
//   public function index(Request $request)
//   {
//     //   dd($request->tags);
//       $tags = Tag::all();
      
//       $pref = $request->pref;
//       $city = $request->city;
//       $place = $request->place;
//       // $tags = $request->tags;
      
//       $query = Post::query();
      
//     //   $query->orWhere('pref', $pref)->orWhere('city', 'like', '%'.$city.'%')->orWhere('place',$place);
      
//       if ($pref != '') {
//          $query->where('pref', $pref);
//       }
      
//       if(!empty($city)) {
//          $query->where('city', 'like', '%'.$city.'%');
//          }
      
//       if ($place != '') {
//          $query->where('place', 'like', '%'.$place.'%');
//       }
       
//       if ($request->tags && 0 < count($request->tags)){
//         // 画面から来たタグを持つ投稿をすべて検索する。（idはpostのid）
//         $query->whereIn('id', Post::getPostIdbyTags($request->tags));
//       }
    
      
//       $posts = $query->get();
      
//       return view('admin.dogs.index', ['posts' => $posts, 'pref' => $pref, 'tags' => $tags]);
//   }
    
    
    public function show($user_id){
        
        $user = User::find($user_id);
        
        return view('dogs.show', ['user' => $user]);
    }
    
    
          public function profile_add()
      {
          return view('admin.dogs.create_profile');
      }
    
    // プロフィールを新規作成
    public function create_profile(Request $request){
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
        // 対象のURLにアクセス、
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
    
    
    //投稿したコンテンツ一覧を表示
    //$user_idに直す
    public function mycontents(Request $request)
    {
        $profile = Profile::find($request->id);
        
        return view('admin.dogs.mycontents', ['user' => Auth::user(),'profile',$profile]);
    }
    
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
    
    //投稿したコンテンツを削除
    public function mycontents_update(Request $request)
    {
        //Validationをかける（入力チェック）PostModelの$rules
        $this->validate($request,Post::$rules);
        //PostModelからコンテンツを取得
        $posts = Post::find($request->id);
        //送信されてきたフォームデータを格納する
        $posts = $request->all();
        // いる？
        // unset($news_form['_token']);
        
        //該当データを上書きして保存する
        $posts->fill($posts)->save();
        
        $post->tags()->detach();
        if (0 < count($request->tags)) {
        foreach($request->tags as $tagid) {
            $post->tags()->attach($tagid);
        }
    }
        
        return redirect('admin/dogs/mycontents');
    }
    
    public function mypage(){
        
       $user = Auth::user();
        
        return view('admin.dogs.mypage', ['user' => $user]);
    }
}
