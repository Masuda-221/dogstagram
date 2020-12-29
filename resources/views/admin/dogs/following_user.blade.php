@extends('layouts.dogs')

@section('title', '投稿一覧')

@section('content')
<div class="container mt-5">
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