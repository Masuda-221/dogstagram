@extends('layouts.dogs')

@section('title', '投稿一覧')

@section('content')
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
      </div>
    </div>
  </div>
  <div class="conteiner">
    <div class="row">
        @foreach($user->posts as $post)
            <div class="card" style="width: 18rem;">
                <img class="bd-placeholder-img card-img-top" width="100%" height="180" src="{{ secure_asset('storage/image/' . $post->image_path) }}"/>
                <div class="card-body">
                    <h5 class="card-title"　maxlength="10">{{ $post->place }}</h5>
                    <p class="card-text">{{ $post->city }}</p>
                    <p class="card-text">{{ $post->body }}</p>
                    {{--公開ページなので編集つけたらだめ
                    <div>
                        <a href="{{ action('Admin\DogsController@mycontents_edit', ['id' => $post->id]) }}">編集</a>
                    </div>--}}
                </div>
            </div>
        @endforeach
      </div>
  </div>
@endsection