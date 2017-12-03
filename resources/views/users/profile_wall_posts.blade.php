@extends('master.master')

@section('main-content')

<h1 class="page-header">{{ $user->name }} - wall posts</h1>
  <div class="row">
    <div class="col-md-12">
     @if(count($wall_posts) > 0)
      <div class="panel panel-default">
        <div class="panel-body">

        @foreach($wall_posts as $post)

          @include('inc.post.single_post')

        @endforeach

        </div>
      </div>
    @else
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="col-md-5"><img class="post-avatar thumbnail img-responsive" style="height: 100px;" src="/img/no_post.png"></div>  
          <div class="col-md-7"><p style="font-weight: bold; font-size: 1.2em; color: #033769;">You have not posted to the Wall!</p></div>
          
        </div>
      </div>
    @endif
    </div>
</div><br>

  
@endsection