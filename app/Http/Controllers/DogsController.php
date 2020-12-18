<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\User;
use App\Profile;
use Auth;

class DogsController extends Controller
{
  // 投稿された記事の一覧を表示する
  public function index(Request $request)
  {
    //   dd($request->tags);
      $tags = Tag::all();
      
      $pref = $request->pref;
      $city = $request->city;
      $place = $request->place;
      // $tags = $request->tags;
      
      $query = Post::query();
      
    //   $query->orWhere('pref', $pref)->orWhere('city', 'like', '%'.$city.'%')->orWhere('place',$place);
      
       if ($pref != '') {
         $query->where('pref', $pref);
       }
      
       if(!empty($city)) {
         $query->where('city', 'like', '%'.$city.'%');
         }
      
       if ($place != '') {
         $query->where('place', 'like', '%'.$place.'%');
       }
       
      if ($request->tags && 0 < count($request->tags)){
        // 画面から来たタグを持つ投稿をすべて検索する。（idはpostのid）
        $query->whereIn('id', Post::getPostIdbyTags($request->tags));
      }
    
      
      $posts = $query->get();
      
      return view('dogs.index', ['posts' => $posts, 'pref' => $pref, 'tags' => $tags]);
  }
  
   public function show($user_id){
        
        $user = User::find($user_id);
        
        return view('dogs.show', ['user' => $user]);
    }
}