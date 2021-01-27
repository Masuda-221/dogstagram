@if(Auth::check())

@if (Auth::id() == $user->id)

<a href="{{ action('Admin\DogsController@mycontents_edit', ['id' => $post->id]) }}">編集</a>

@endif

@endif