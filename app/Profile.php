<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $guarded = array('id');
    
    public static $rules = array(
        'image' => 'required',
        'nickname' => 'required',
    );
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
