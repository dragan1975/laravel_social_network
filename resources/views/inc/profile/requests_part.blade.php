<div class="row">
	<h3>Friends 
	@if(auth()->id() == $user->id)
		and requests
	@endif
	</h3>
	<div class="col-md-6">
	  <h4>Friends</h4>
	  <ul class="list-group">
	    @foreach($friends as $friend)
	    <li class="list-group-item"><a href="/profile/{{ $friend->id }}">{{ $friend->name }}</a></li>
	    @endforeach
	  </ul>
	</div>
	@if(auth()->id() == $user->id)
	<div class="col-md-6">
	  <h4>Requests</h4>
	  <ul class="list-group">
	    @foreach($users_req as $user_req)
	    <li class="list-group-item"><a href="/profile/{{ $user_req->id }}">{{ $user_req->name }}</a>
	    	<div class="pull-right">
	    		<a href="/user/{{$user->id}}/request/{{$user_req->id}}/accept"><span class="glyphicon glyphicon-ok"></span></a> |
		    	<a href="/user/{{$user->id}}/request/{{$user_req->id}}/refuse"><span class="glyphicon glyphicon-remove"></span></a>
	    	</div>	    	
	    </li>
	    @endforeach
	  </ul>
	</div>
	@endif

</div><br><br>