@extends('layouts.dogs')
@section('title', '登録済みコンテンツの一覧')

@section('content')
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