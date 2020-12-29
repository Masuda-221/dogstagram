@extends('layouts.dogs')

@section('title', 'マイページ')

@section('content')
<div class="container mt-5 ">
  <div class="row mb-5">
    <div class="col-md-4 text-center">
      @if ($user->profile->image)
          <div class="profile_image" style="width: 18rem;">
            <img style="object-fit: cover;  width:100%; height:180; "　src="{{ secure_asset('storage/image/' . $user->profile->image) }}"/>
          </div>
      @else
        <img class="" src="{{ secure_asset('/images/blank_profile.png') }}"/>
      @endif
    </div>
    <div class="col-md-8">
      <div class="row">
        <h1>{{ $user->profile->nickname }}</h1>
        
        <a class="btn btn-outline-dark common-btn edit-profile-btn" href="/admin/dogs/edit?id={{$user->profile->id}}">プロフィールを編集</a>
        {{--<a class="btn btn-outline-dark common-btn edit-profile-btn" rel="nofollow" data-method="POST" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>--}}
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
      </div>
        <div class="row"> 
          <p>
            {{ $user->email }}
          </p>
        </div>
        <div class="row">
          <p>
            {{ $user->profile->profile_body }}
          </p>
        </div>
        
        
      </div>
  </div>
  
   @foreach($user->posts as $post)
          <img src="{{ secure_asset('storage/image/' . $post->image_path) }}"　class="img-fluid"/>
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
          {{--コメントここまで--}}
          <h5>{{ $post->place }}</h5>
          <h5>{{ $post->city }}</h5>
          <h5>{{ $post->body }}</h5>
          <div>
            <a href="{{ action('Admin\DogsController@mycontents_edit', ['id' => $post->id]) }}">編集</a>
          </div>
          
    @endforeach
    
</div>
 
@endsection