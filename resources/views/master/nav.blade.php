<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="{{ Request::path() == '/' ? 'active' : '' }}"><a href="{{url('/')}}">Home</a></li>
        <li class="{{ Request::path() == 'members' ? 'active' : '' }}"><a href="{{url('/members')}}">Members</a></li>
        <li class="{{ Request::path() == 'groups' ? 'active' : '' }} dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" >Groups <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{url('/groups')}}">Groups</a></li>
            @if(Auth::check())
            <li><a href="{{url('/group/create')}}">New group</a></li>
            @endif
          </ul>
        </li>
        @if(Auth::check())
        <li class="{{ Request::path() == 'profile' ? 'active' : '' }}"><a href="{{url('/profile/' . Auth::user()->id)}}">Profile</a></li>
        @endif
        @if(!Auth::check())
        <li class="{{ Request::path() == 'register' ? 'active' : '' }}"><a href="{{url('/register')}}">Register</a></li>
        @endif
        
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>