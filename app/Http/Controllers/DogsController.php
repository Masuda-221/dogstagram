<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;

class DogsController extends Controller
{
    public function index(Request $request)
    {
      $tags = Tag::all();
      
      $pref = $request->pref;
      $city = $request->city;
      $place = $request->place;
      // $tags = $request->tags;
      
      $query = Post::query();
      
      $query->orWhere('pref', $pref)->orWhere('city', 'like', '%'.$city.'%')->orWhere('place',$place);
      
      $posts = $query->get();
      
      return view('dogs.index', ['posts' => $posts, 'pref' => $pref, 'tags' => $tags]);
      
    }
}
