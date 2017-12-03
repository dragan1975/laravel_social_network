@extends('master.master')

@section('main-content')

    @include('inc.errors')
    @include('flash::message')

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Wall</h3>
      </div>
      @if(Auth::check())
        <div class="panel-body">
          <form method="POST" action="/post">
            {{csrf_field()}}
            <div class="form-group">
              <textarea class="form-control" placeholder="Write on the wall" name="body"></textarea>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
        </div>
      @else
        <div class="panel-body">
          <span style="font-size: 1.35em">Please sign in to write on the wall!</span>
        </div>
      @endif      
    </div>

    @foreach($posts as $post)
      @include('inc.post.single_post')
    @endforeach

    <div class="text-center">
      {{ $posts->links() }}
    </div>
    
    
@endsection