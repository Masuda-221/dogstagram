{{-- layouts/dogs.blade.phpを読み込む --}}
@extends('layouts.dogs')


{{-- dogs.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '投稿作成ページ')

{{-- dogs.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 mx-auto">
                
                <form action="{{ action('Admin\DogsController@create') }}" method="post" enctype="multipart/form-data">
                
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
            
                
                    <div class="main">
                        
                        <div class="contents">
                            <div class="form-group row">
                                <label class="col-md-10" for="title">画像</label>
                                <div class="col-md-10">
                                    <input type="file" class="form-control-file" name="image">
                                </div>
                            </div>
                        </div>
                        
                        <div class="contents">
                            <div class="form-group row">
                                <label class="col-md-2" for="body">本文</label>
                                <div class="col-md-12">
                                    <textarea class="form-control" name="body" rows="10">{{ old('body') }}</textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="contents"> 
                            <div class="form-group row mt-2">
                                <label class="col-md-2" for="title">都道府県</label>
                                <div class="col-md-3">
                                    <select type="text" class="form-control" name="pref">                          
                                        @foreach(config('pref') as $key => $score)
                                            <option value="{{ $score }}">{{ $score }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        
                            <div class="form-group row">
                                <label class="col-md-2" for="title">市町村</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="city" value="{{ old('city') }}">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-md-2" for="title">キーワード</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="place" value="{{ old('name') }}">
                                </div>
                            </div>
                        </div>
                            
                        @foreach ($tags as $tag)
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}">{{ $tag->name }}
                        @endforeach
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-primary" value="投稿">
                    </div>    
                </form>
            </div>
        </div>
    </div>
@endsection