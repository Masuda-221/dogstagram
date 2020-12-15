{{--dogs.index.blade.php に以降しました
@extends('layouts.dogs')
@section('title','投稿一覧')

@section('content')

{{--いらない
<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
    サインアウト<br/>
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
{{ csrf_field() }}
</form>

    <div class="container">
        
        <div class="row">
            <form action="{{ action('Admin\DogsController@index') }}" method="get">
            
                <div class="TopSerch">
                    <div class="form-group row" >
                        
                        <div class="col-md-2">
                            <select type="text" class="form-control" name="pref"　value="{{ "pref" }}">
                                <option disabled selected value>都道府県</option>
                                @foreach(config('pref') as $key => $score)
                                            <option value="{{ $score }}">{{ $score }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="city" placeholder="市町村">
                        </div>
                        
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="place" placeholder="店名または場所名">
                        </div>
                        
                    </div>
                    asdjkl
                    
                    @foreach ($tags as $tag)
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}">{{ $tag->name }}
                    @endforeach
                            
                    <input type="submit" class="btn btn-primary" value="その他↓">
                        
                    <div class="col-md-4">
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-primary" value="検索">
                    </div>
                </div>
                
                <div class="row">
                    @foreach($posts as $post)
                        <div class="card" style="width: 18rem;">
                            <img class="bd-placeholder-img card-img-top" width="100%" height="180" src="{{ secure_asset('storage/image/' . $post->image_path) }}"/>
                            <div class="card-body">
                                <h5 class="card-title"　maxlength="10">{{ $post->place }}</h5>
                                <p class="card-text">{{ $post->city }}</p>
                                <p class="card-text">{{ $post->body }}</p>
                                <p class="card-text">{{ $post->user->profile->nickname }}</p>
                            </div>
                        </div>
                        {{--<td><img src="{{ secure_asset('storage/image/' . $post->image_path) }}"></td>
                        <td>{{ $post->pref }}</td>
                        <td>{{ $post->body }}</td>
                        <td>{{ $post->place }}</td>
                    @endforeach
                    
                </div>
            </form>
            
            
        </div>
        
    </div>
@endsection--}}