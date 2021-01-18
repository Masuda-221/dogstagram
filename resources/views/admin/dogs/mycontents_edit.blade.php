@extends('layouts.dogs')

@section('title', '投稿編集ページ')

@section('content')
    <div class="container mt-5">
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
                    <input type="text" class="form-control" name="city" value="{{ $posts->city }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2" for="name">キーワード・店名</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="place" value="{{ $posts->place }}">
                </div>
            </div>
            <div class="form-group row　align-items-center">
            @foreach ($tags as $tag)
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}">{{ $tag->name }}
            @endforeach
            </div>
            <div class="form-group row">
                <div class="col-md-10">
                    <input type="hidden" name="id" value="{{ $posts->id }}">
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </div>
            </div>
        </form>
    
        @if ($posts->user->id == Auth::user()->id)
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
              削除
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">投稿の削除</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            本当に削除しますか？
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">戻る</button>
                            <form action="{{ action('Admin\DogsController@postsdestroy',['post_id'=>$posts->id]) }}" method="post">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-primary">削除</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
       
    </div>
@endsection