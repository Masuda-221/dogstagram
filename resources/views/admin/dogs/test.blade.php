{{-- layouts/dogs.blade.phpを読み込む --}}
@extends('layouts.dogs')


{{-- dogs.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '投稿作成ページ')

{{-- dogs.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')

@endsection