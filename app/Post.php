<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tag;

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
}
