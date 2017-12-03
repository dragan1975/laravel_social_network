 @if(count($groups) > 0)
  <div class="row">
    <div class="col-md-8">
       <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Groups</h3>
          </div>
          <div class="panel-body">
            <ul class="list-group">
              @if($groups)
                @foreach($groups as $group)
                <a href="/group/{{ $group->id }}"><li class="list-group-item">{{$group->name}}</li></a>
                @endforeach
              @else
                <li class="list-group-item">No group is founded by {{ $user->name }}.</li>
              @endif  
            </ul>
          </div>
        </div>
    </div>    
  </div>
  @endif