@extends('layouts.dogs')
@section('title','投稿一覧')

@section('content')

{{--<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
    サインアウト<br/>
</a>--}}
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
{{ csrf_field() }}
</form>

    <div class="container mt-5 ">
            <div class="content">
                <form action="{{ action('DogsController@index') }}" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <select type="text" class="form-control text-secondary" name="pref"　value="{{ "pref" }}">
                                <option disabled selected value>都道府県</option>
                                @foreach(config('pref') as $key => $score)
                                            <option value="{{ $score }}">{{ $score }}</option>
                                @endforeach
                            </select></div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="city" placeholder="市町村">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="place" placeholder="キーワード・店名">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-12 mt-4 mb-5 text-center">
                            @foreach ($tags as $tag)
                                <input type="checkbox" class="tags ml-2" name="tags[]" value="{{ $tag->id }}">{{ $tag->name }}
                            @endforeach
                            {{ csrf_field() }}
                            <input type="submit" class="ml-2 btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        
        <div id="Gallery" class="row gallery pad-top-sm">
            @foreach($posts as $post)
                <div class="card mx-auto mt-2" style="width: 23rem;">
                    {{--<img class="img-responsive-100 bd-placeholder-img card-img-top" width="100%" height="180" src="{{ secure_asset('storage/image/' . $post->image_path) }}"/>--}}
                    <img class="img-responsive-100 bd-placeholder-img card-img-top" width="100%" height="180" src="{{ $post->image_path }}"/>
                    <div class="card-body">
                        @Auth
                            <div class="row align-items-center pl-2 pb-2">
                                <div id="like-icon-post-{{ $post->id }}" class="mr-1">
                                    @if ($post->likedBy(Auth::user())->count() > 0)
                                        {{--relでファイルとの関係性を、hrefで そのファイルがある場所（URL）を指定--}}
                                        <a class="loved hide-text" data-remote="true" rel="nofollow" data-method="DELETE" href="/likes/{{ $post->likedBy(Auth::user())->firstOrFail()->id }}">いいねを取り消す</a>
                                    @else
                                        <a class="love hide-text" data-remote="true" rel="nofollow" data-method="POST" href="/posts/{{ $post->id }}/likes">いいね</a>
                                    @endif
                                </div>
                                {{-- likesがnullじゃなかったら　--}}
                                @if ($post->likes != NULL)
                                    {{ $post->likes->count() }}
                                @endif
                            </div>
                        @endauth
                        <!--投稿内容-->
                        <p class="card-text card-maintext" maxlength="20">{{ $post->place }}</p>
                        <p class="card-text card-maintext" maxlength="20">{{ $post->city }}</p>
                        <p class="card-text">
                        <strong>
                            <a class="no-text-decoration black-color" href="{{ action('DogsController@show', ['user_id' => $post->user_id]) }}">{{ $post->user->name }}</a>
                        </strong>
                        </span>
                        <span>{{ $post->body }}</span>
                        </p>
                        <!--spanでは前後に改行が入りません。一方divではまとまりの前後に改行が入ります。-->
                    
                        <div id="comment-post-{{ $post->id }}">
                        <!--コメントの削除ボタン   -->
                            @foreach ($post->comments as $comment) 
                                <div class="mb-2">
                                    @Auth
                                        @if ($comment->user->id == Auth::user()->id)
                                            <a class="delete-comment" data-remote="true" rel="nofollow" data-method="delete" href="/comments/{{ $comment->id }}"></a>
                                        @endif
                                    @endauth
                                    <span>
                                    <strong>
                                        <a class="no-text-decoration black-color" {{--href="/users/{{ $comment->user->id"--}}>{{ $comment->user->name }}</a>
                                        <!--<a class="no-text-decoration black-color" href="{{ action('DogsController@show', ['user_id' => $comment->user_id]) }}">{{ $comment->user->name }}</a>-->
                                    </strong>
                                    </span>
                                    <span>{{ $comment->comment }}</span>
                                </div>
                            @endforeach
                        </div>
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
        
@endsection