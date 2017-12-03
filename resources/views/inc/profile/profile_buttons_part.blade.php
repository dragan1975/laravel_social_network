 @if(auth()->id() == $user->id)
  <div class="row">
    <div class="col-md-12">

      <div class="col-md-3">
        <p><a href="/profile/{{ $user->id }}/wall-posts" class="btn btn-default btn-block">My Wall Posts</a></p>
      </div>

      <div class="col-md-3">
        <p><a href="/profile/{{ $user->id }}/messages" class="btn btn-default btn-block">See Massages</a></p>
      </div>

      <div class="col-md-3">
        <p><a href="#editProfile" class="btn btn-default btn-block">Edit Profile</a></p>
      </div>

    </div>
    
    </div><br><br>
  @else
    @if( Auth::check() && !in_array(auth()->user(), $friends) && !in_array(auth()->user(), $users_req))
   <div class="col-md-3">
      <p><a href="/user/{{ Auth::id() }}/request/{{ $user->id }}" class="btn btn-default btn-block">Add Friend</a></p>
    </div><br><br>
    @endif
  @endif