<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Like;
use App\Post;
use Auth;


class LikesController extends Controller
{
    public function store(Request $request)
    {
        //likeモデル作成
        $like = new Like;
        $like->post_id = $request->post_id;
        $like->user_id = Auth::user()->id;
        $like->save();
        
        return redirect('/');
    }
    
    public function destroy(Request $request)
    {
        $like = Like::find($request->like_id);
        $like->delete();
        
        return redirect('/');
    }
    
    
    public function storeShow(Request $request)
    {
        //likeモデル作成
        $like = new Like;
        $like->post_id = $request->post_id;
        $like->user_id = Auth::user()->id;
        $like->save();
        $user_id = Post::find($like->post_id)->user_id;
        
        return redirect('dogs/show/' . $user_id);
    }
    
    public function destroyShow(Request $request)
    {
        $like = Like::find($request->like_id);
        $user_id = Post::find($like->post_id)->user_id;
        $like->delete();
        
        return redirect('dogs/show/' . $user_id);
    }
    
}
