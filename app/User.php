<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    // プロフィールと１対１、hasOneメソッドの最初の引数は関係するモデルの名前
    public function profile()
    {
        return $this->hasOne('App\Profile');
    }
    
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
    
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
