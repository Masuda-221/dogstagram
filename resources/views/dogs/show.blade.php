@extends('layouts.dogs')

@section('title', '投稿一覧')

@section('content')
<div class="container mt-5">
    <div class="profile-wrap">
        <div class="row">
            <div class="col-md-4 text-center">
            @if (!empty($user->profile->image))
              <img class="round-img" src="{{ $user->profile->image }}"/>
            @else
              <img class="round-img" src="{{ secure_asset('/images/blank_profile.png') }}"/>
            @endif
            </div>
            <div class="col-md-8">
                <div class="row">
                  @if(!empty($user->profile->nickname))
                  <h1>{{ $user->profile->nickname }}</h1>
                  @else
                  <h1 class="text-secondary">ニックネームは未設定です</h1>
                  @endif
                  
                  <!--@if(!empty($user->profile->id))-->
                  <!--<a class="btn btn-outline-dark common-btn edit-profile-btn" href="/admin/dogs/edit?id={{$user->profile->id}}">プロフィールを編集</a>-->
                  <!--{{--<a class="btn btn-outline-dark common-btn edit-profile-btn" rel="nofollow" data-method="POST" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>--}}-->
                  <!--@else-->
                  <!--<h1>　</h1>-->
                  <!--@endif-->
                  
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                </div>
                
                <div class="row"> 
                    <p>
                    {{ $user->email }}
                    </p>
                </div>
                <div class="row">
                  @if(!empty($user->profile->profile_body))
                  <h5>
                    {{ $user->profile->profile_body }}
                  </h5>
                  @else
                  <h5 class="text-secondary">本文は未設定です</h5>
                  @endif
                </div>
                <div class="row">
                    @include('dogs.follow_button',['user'=>$user])
                    
                    <ul class="nav nav-tabs nav-justified followtable">
                        <li class="nav-item" href="{{ route('followers',['id'=>$user->id]) }}" class="">　フォロワー　<br><div class="">{{ $count_followers }}</div></a></li>
                        <li class="nav-item" href="{{ route('followings',['id'=>$user->id]) }}" class="">　フォロー中　<br><div class="">{{ $count_followings }}</div></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
  
    <div class="row">
      @foreach($user->posts as $post)
      <div class="card mx-auto" style="width: 70rem;">
        <img class="img-responsive-100 bd-placeholder-img card-img-top" width="100%" height="180" src="{{ $post->image_path }}"/>
        <div class="card-body">
          @Auth
            <div class="row align-items-center pl-2 pb-2">
              <div id="like-icon-post-{{ $post->id }}" class="mr-1">
                @if ($post->likedBy(Auth::user())->count() > 0)
                    {{--relでファイルとの関係性を、hrefで そのファイルがある場所（URL）を指定--}}
                    <a class="loved hide-text" data-remote="true" rel="nofollow" data-method="DELETE" href="/likes/show/{{ $post->likedBy(Auth::user())->firstOrFail()->id }}">いいね���取り消す</a>
                @else
                    <a class="love hide-text" data-remote="true" rel="nofollow" data-method="POST" href="/posts/{{ $post->id }}/likes/show">いいね</a>
                @endif
              </div>
              {{-- likesがnullじゃなかったら　--}}
              @if ($post->likes != NULL)
              {{ $post->likes->count() }}
              @endif
            </div>
            <div id="like-text-post-{{ $post->id }}">
            @include('dogs.like_text')
            </div>
          @endauth
          
          <p class="card-text card-maintext">{{ $post->place }}</p>
          <p class="card-text card-maintext">{{ $post->city }}</p>
          <p class="card-text card-maintext">{{ $post->body }}</p>
          <div>
            <a href="{{ action('Admin\DogsController@mycontents_edit', ['id' => $post->id]) }}">編集</a>
          </div>
          
          {{--コメントを表示する--}}
          @foreach ($post->comments as $comment) 
            <div class="mb-2">
                
              @Auth
                @if ($comment->user->id == Auth::user()->id)
                <a class="delete-comment" data-remote="true" rel="nofollow" data-method="delete" href="/comments/{{ $comment->id }}"></a>
                @endif
              @endauth
              
              <span>
              <strong>
              <a class="no-text-decoration black-color" href="/users/{{ $comment->user->id }}">{{ $comment->user->name }}</a>
              </strong>
              </span>
              <span>{{ $comment->comment }}</span>
              
            </div>
          @endforeach
          
          @Auth
            <a class="light-color post-time" href="/posts/{{ $post->id }}">{{ $post->created_at }}</a>
            <div class="row actions" id="comment-form-post-{{ $post->id }}">
              <form class="w-100" id="new_comment" action="/posts/{{ $post->id }}/comments" accept-charset="UTF-8" data-remote="true" method="post"><input name="utf8" type="hidden" value="&#x2713;" />
                {{csrf_field()}} 
                
                <input value="{{ $post->id }}" type="hidden" name="post_id" />
                <input class="form-control comment-input border-0" placeholder="コメント ..." autocomplete="off" type="text" name="comment" />
              </form>
            </div>
          @endauth
        </div>
        
      </div>
      @endforeach
    </div>
  </div>
@endsection