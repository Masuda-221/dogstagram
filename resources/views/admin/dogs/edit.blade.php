@extends('layouts.dogs')
@section('title', 'プロフィール編集')
@section('content')

<div class="container mt-5">
    @if (count($errors) > 0)
        <ul>
            @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
            @endforeach
        </ul>
    @endif
    <form class="edit_user" enctype="multipart/form-data" action="{{ action('Admin\DogsController@update') }}" method="post">
    <input type="hidden" name="id" value="{{ $user->profile->id }}" />
    {{csrf_field()}} 
    
    <div class="main">
        <div class="contents img-responsive">
            <label for="image">プロフィール写真</label><br>
            @if ($user->profile->image)
            <p>
                <img src="{{ asset('storage/image/' . $user->profile->image) }}" lass="form-control"alt="avatar" />
            </p>
            @endif
            <input type="file" name="image" accept="image/jpeg,image/gif,image/png" />
        </div>
        
        <div class="contents">
            <label for="user_nickname">名前</label>
            <input autofocus="autofocus" class="form-control" type="text" value="{{ old('nickname',$user->profile->nickname) }}" name="nickname" />
        </div>
        <div class="contents mb-3"> 
            <label for="user_profile_body">本文</label>
            <input autofocus="autofocus" class="form-control" type="text" value="{{ old('profile_body',$user->profile->profile_body) }}" name="profile_body" />
        </div>
        
        <input type="submit" value="変更する" class="btn btn-primary" data-disable-with="変更する" />
    </div>    
</div>
@endsection