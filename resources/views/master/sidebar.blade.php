<div class="panel panel-default friends">
    <div class="panel-heading">
      <h3 class="panel-title">My Friends</h3>
    </div>
    <div class="panel-body">
      <ul>
        @foreach($randomMembers as $member)
        <li>
          <a href="/profile/{{ $member->id }}" class="thumbnail">
            @if($member->imagePath == 'img/user.png')
            @continue($member->id == Auth::id())
            <img src="{{ asset('img/user.png') }}" alt="">
            @else
            <img src="{{ str_replace('public','storage',asset($member->imagePath)) }}" alt="">
            @endif
          </a>
       </li>
        @endforeach
      </ul>
      <div class="clearfix"></div>
      <a class="btn btn-primary" href="/members">View All Friends</a>
    </div>
  </div>

  <div class="panel panel-default groups">
    <div class="panel-heading">
      <h3 class="panel-title">Latest Groups</h3>
    </div>
    <div class="panel-body">
      @foreach($latestGroups as $group)
        <div class="group-item">
          @if($group->imagePath == 'img/group.png')
          <img src="img/group.png" alt="">
          @else
           <img src="{{ str_replace('public','storage',asset($group->imagePath)) }}" alt="">
          @endif
          <h4><a href="/group/{{ $group->id }}" class="">{{ $group->name }}</a></h4>
          <span class="pull-right" style="color: #337ab7; font-size: 0.8em; font-style: italic;">{{ $group->created_at->diffForHumans() }}</span>        
        </div>
        <div class="clearfix"></div>
      @endforeach
      <a href="/groups" class="btn btn-primary">View All Groups</a>
    </div>
  </div>
</div>