@if(Auth::check())

    @if (Auth::id() == $user->id)

        @if(!empty($user->profile->id))
        <a class="btn btn-outline-dark common-btn edit-profile-btn" href="/admin/dogs/edit?id={{$user->profile->id}}">プロフィールを編集</a>
        @endif    
    
    @endif

@endif


