@extends('layouts.dogs')

@section('title', 'マイページ')

@section('content')
  <div class="profile-wrap">
    <div class="row">
      <div class="col-md-4 text-center">
        @if ($user->profile->image)
          <p>
            <div class="profile_image" style="width: 18rem;">
            <img style="object-fit: cover;  width:100%; height:180; "　src="{{ asset('storage/image/' . $user->profile->image) }}"/>
            </div>
          </p>
          @else
            <img class="" src="{{ asset('/images/blank_profile.png') }}"/>
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
                    <div>
                        <a href="{{ action('Admin\DogsController@mycontents_edit', ['id' => $post->id]) }}">編集</a>
                    </div>
                </div>
            </div>
        @endforeach
      </div>
  </div>
@endsection