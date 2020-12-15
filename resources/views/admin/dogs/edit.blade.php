@extends('layouts.dogs')
@section('title', 'プロフィール編集')

@section('content')
<div class="container">
  <div class="row">
@if (count($errors) > 0)
<ul>
@foreach($errors->all() as $e)
<li>{{ $e }}</li>
@endforeach
</ul>
@endif

    {{--<tr>
      <th>{{ $user->profile->id}}</th>
      <td>{{ $user->profile->nickname}}</td>
    </tr>--}}
    
 <div class="col-md-offset-2 mb-4 edit-profile-wrapper">
  <div class="row">
    <div class="col-md-8 mx-auto">
      <div class="profile-form-wrap">
        {{--サブミットが押されると、form内のアクションになる--}}
        <form class="edit_user" enctype="multipart/form-data" action="{{ action('Admin\DogsController@update') }}" method="post">
          <input type="hidden" name="id" value="{{ $user->profile->id }}" />
          {{csrf_field()}} 
          <div class="form-group">
            <label for="image">プロフィール写真</label><br>
                @if ($user->profile->image)
                    <p>
                        <img src="{{ asset('storage/image/' . $user->profile->image) }}" alt="avatar" />
                    </p>
                @endif
           <input type="file" name="image" accept="image/jpeg,image/gif,image/png" />
          </div>

          <div class="form-group">
            <label for="user_nickname">名前</label>
            <input autofocus="autofocus" class="form-control" type="text" value="{{ old('nickname',$user->profile->nickname) }}" name="nickname" />
          </div>
          <div class="form-group">
            <label for="user_profile_body">本文</label>
            <input autofocus="autofocus" class="form-control" type="text" value="{{ old('profile_body',$user->profile->profile_body) }}" name="profile_body" />
          </div>
          {{--<div class="form-group">
            <label for="user_email">メールアドレス</label>
            <input autofocus="autofocus" class="form-control" type="email" value="{{ old('user_email',$user->email) }}" name="user_email" />
          </div>

          <div class="form-group">
            <label for="user_password">パスワード</label>
            <input autofocus="autofocus" class="form-control" type="password" value="{{ old('user_password',$user->password) }}" name="user_password" />
          </div>

          <div class="form-group">
            <label for="user_password_confirmation">パスワードの確認</label>
            <input autofocus="autofocus" class="form-control" type="password" name="user_password_confirmation" />
          </div>--}}

          <input type="submit" value="変更する" class="btn btn-primary" data-disable-with="変更する" />
        </div>
      </form>
    </div>
  </div>
</div>
@endsection