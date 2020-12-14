@extends('layouts.dogs')

@section('title', 'マイページ')

@section('content')
  <div class="profile-wrap">
    <div class="row">
      <div class="col-md-4 text-center">
        @if ($user->profile->image)
          <p>
            <img class="round-img" src="{{ asset('storage/image/' . $user->profile->image) }}"/>
          </p>
          @else
            <img class="round-img" src="{{ asset('/images/blank_profile.png') }}"/>
        @endif
      </div>
      <div class="col-md-8">
        <div class="row">
          <h1>{{ $user->profile->nickname }}</h1>
            
            <a class="btn btn-outline-dark common-btn edit-profile-btn" href="/admin/dogs/edit?id={{$user->id}}">プロフィールを編集</a>
            <a class="btn btn-outline-dark common-btn edit-profile-btn" rel="nofollow" data-method="POST" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            
        </div>
        <div class="row">
          <p>
            {{ $user->email }}
  
          </p>
        </div>
      </div>
    </div>
  </div>
@endsection