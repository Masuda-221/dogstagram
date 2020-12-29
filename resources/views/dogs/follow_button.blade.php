@if(Auth::check())

    @if (Auth::id() != $user->id)

        @if (Auth::user()->is_following($user->id))
        
            <form method="post" action="{{ route('unfollow', [$user->id]) }}">
                {{csrf_field()}} 
                @method('delete')
                <button type="submit" class="btn btn-primary">
                    このユーザーのフォローを外す
                </button>
            </form>
        @else
            
            <form method="post" action="{{ route('follow', [$user->id]) }}">
                {{csrf_field()}} 
                <button type="submit" class="btn btn-primary">
                    このユーザをフォローする
                </button>
            </form>
            
        @endif
    
    @endif

@endif