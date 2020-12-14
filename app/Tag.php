<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    
    
    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }
    
    public function postIds()
    {
        return $this->belongsToMany('App\Post','post_id');
    }
}
