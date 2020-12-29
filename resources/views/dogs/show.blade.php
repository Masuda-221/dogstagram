@extends('layouts.dogs')

@section('title', '投稿一覧')

@section('content')
<div class="container mt-5">
  <div class="profile-wrap">
    <div class="row">
      <div class="col-md-4 text-center">
        @if ($user->profile->image)
          <p>
            <img class="image" src="{{ secure_asset('storage/image/' . $user->profile->image) }}"/>
            
          </p>
          @else
            <img class="round-img" src="{{ asset('/images/blank_profile.png') }}"/>
        @endif
      </div>
      <div class="col-md-8">
        <div class="row">
          <h1>{{ $user->profile->nickname }}</h1>
 
        </div>
        <div class="row">
          <p>
            {{ $user->profile->profile_body }}
  
          </p>
        </div>
        <div class="row">
          @include('dogs.follow_button',['user'=>$user])
          <ul class="nav nav-tabs nav-justified mt-5 mb-2">
            <li class="nav-item nav-link {{ Request::is('users/*/followers') ? 'active' : '' }}"><a href="{{ route('followers',['id'=>$user->id]) }}" class="">フォロワー<br><div class="badge badge-secondary">{{ $count_followers }}</div></a></li>
            <li class="nav-item nav-link {{ Request::is('users/*/followings') ? 'active' : '' }}"><a href="{{ route('followings',['id'=>$user->id]) }}" class="">フォロー中<br><div class="badge badge-secondary">{{ $count_followings }}</div></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  
  <div class="row">
      @foreach($user->posts as $post)
          <div class="card" style="width: 18rem;">
              <img class="bd-placeholder-img card-img-top" width="100%" height="180" src="{{ secure_asset('storage/image/' . $post->image_path) }}"/>
              <div class="card-body">
                @if ($post->likes != NULL)
                  {{ $post->likes->count() }}
                @else 0
                @endif
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
                  <h5 class="card-title"　maxlength="10">{{ $post->place }}</h5>
                  <p class="card-text">{{ $post->city }}</p>
                  <p class="card-text">{{ $post->body }}</p>
              </div>
          </div>
      @endforeach
    </div>
</div>
@endsection