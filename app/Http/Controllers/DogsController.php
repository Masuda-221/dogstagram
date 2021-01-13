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
  
   public function show($user_id)
   {
        $user = User::find($user_id);
        $count_followings = $user->followings()->count();
        $count_followers = $user->followers()->count();
        
        
        return view('dogs.show', ['user' => $user,'count_followings' => $count_followings,'count_followers' => $count_followers]);
    }
  
  public function followings($id)
    {
        $user = User::find($id);
        $followings = $user->followings()->paginate(9);

        $data = [
            'user' => $user,
            'users' => $followings,
        ];

        $data += $this->counts($user);

        return view('dogs.show', $data);
    }

    public function followers($id)
    {
        $user = User::find($id);
        $followers = $user->followers()->paginate(9);

        $data = [
            'user' => $user,
            'users' => $followers,
        ];

        $data += $this->counts($user);

        return view('dogs.show', $data);
    }
  
}