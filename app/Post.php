<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tag;
use App\Like;
use App\User;

class Post extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'image' =>'required',
        );
    
    // 配列にあるタグIDを持つ投稿のIDを配列にして返す
    // 投稿の番号を配列にして返す
    public static function getPostIdByTags($arr) {
        $ret = [];
        foreach ($arr as $tagId) {
            $tag = Tag::find($tagId);
            $tmp = $tag->posts;   
            foreach($tmp as $item) {
                $ret[] = $item->id;
            }
        }
        return $ret;
    } 


    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
    
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    
    //   // user_idが一致するlikeを探して返します。
       
    //     // // A and B
    //     // // 'name'カラムが'名前1'でかつ'name'カラムが'名前2'のレコードを取得したい場合
    //     // $items = Item::where('name', '名前1')->where('name', '名前2')->first();
    
    public function likedBy($user)
  {
    return Like::where('user_id', $user->id)->where('post_id', $this->id);
  }
}
