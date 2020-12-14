{{-- layouts/dogs.blade.phpを読み込む --}}
@extends('layouts.dogs')


{{-- dogs.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '投稿編集ページ')

{{-- dogs.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <form action="{{ action('Admin\DogsController@mycontents_update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="image">画像<span>※必須</span></label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                            <div class="form-text text-info">
                                設定中: {{ $posts->image_path }}
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="body">本文</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="20">{{ $posts->body }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="pref">都道府県</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="pref" value="{{ $posts->pref }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="city">市町村</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="city" value="{{ $posts->citye }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="name">店名または場所名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ $posts->name }}">
                        </div>
                    </div>
                    @foreach ($tags as $tag)
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}">{{ $tag->name }}
                    @endforeach
                    
                    
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $posts->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection