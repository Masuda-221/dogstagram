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
    
    //followings()で「あるユーザがフォローしているユーザ」を取得
    public function followings()
    {
        //第１引数：「Userモデルが、別の複数のUserモデルに所属している」ということを明示
        //第２引数：user_followテーブルという「中間テーブル」でユーザ同士が繋がっていることを示す
        //第３引数：中間テーブルに保存されている主体となるユーザ自身のＩＤカラム（user_id）を設定
        //第４引数：中間テーブルに保存されている関係先（相手）ユーザのＩＤカラム（follow_id）を設定
        return $this->belongsToMany(User::class, 'follow_users', 'user_id', 'follow_id')->withTimestamps();
    }
    
    //followers()は、 第３引数と第４引数を逆にして、「 あるユーザ をフォローしているユーザ」を取得
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follow_users', 'follow_id', 'user_id')->withTimestamps();
    }
    
    //フォロー済みかチェック
    public function is_following($userId)
    {
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
    public function follow($userId)
    {
        // すでにフォロー済みではないか？
        $existing = $this->is_following($userId);
        // フォローする相手がユーザ自身ではないか？
        $myself = $this->id == $userId;
    
        // フォロー済みではない、かつフォロー相手がユーザ自身ではない場合、フォロー
        if (!$existing && !$myself) {
            $this->followings()->attach($userId);
        }
    }
    
    public function unfollow($userId)
    {
        // すでにフォロー済みではないか？
        $existing = $this->is_following($userId);
        // フォローする相手がユーザ自身ではないか？
        $myself = $this->id == $userId;
    
        // すでにフォロー済みならば、フォローを外す
        if ($existing && !$myself) {
            $this->followings()->detach($userId);
        }
    }
}
