@extends('master.master')

@section('main-content')

<h1 class="page-header">{{ $user->name }} - messages</h1>
  <div class="row">
    <div class="col-md-12">
     @if(count($user->messages) > 0)
      <div class="panel panel-default">
        <div class="panel-body">
          <ul class="list-group">
            @foreach($user->messages as $message)
              <li class="list-group-item">{{ $message->body }}
               <span class="pull-right" style="font-style: italic; font-size: 0.85em; color: #033769;"> {{ \App\User::find($message->sender)->name }}</span>
               <span class="pull-right" style="font-style: italic; font-size: 0.85em; color: #033769;">Sent: {{ $message->created_at->diffForHUmans() }} by </span></li><br>

            @endforeach
          </ul>        
        </div>
      </div>
    @else
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="col-md-5"><img class="post-avatar thumbnail img-responsive" style="height: 100px;" src="/img/no_post.png"></div>  
          <div class="col-md-7"><p style="font-weight: bold; font-size: 1.2em; color: #033769;">You have got no messages!</p></div>
          
        </div>
      </div>
    @endif
    </div>
</div><br>

  
@endsection