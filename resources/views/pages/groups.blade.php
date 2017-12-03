@extends('master.master')

@section('main-content')
@include('inc.errors')
@include('flash::message')

<div class="groups">
    <h1 class="page-header">Groups</h1>
    @foreach($groups as $group)
      <div class="group-item">
        @if($group->imagePath == 'img/group.png')
          <img src="img/group.png" alt="">
        @else
          <img src="{{ str_replace('public','storage',asset($group->imagePath)) }}" alt="">
        @endif
        <h4><a href="/group/{{ $group->id }}">{{ $group->name }}</a></h4>
        <p>{{ $group->description }}
        <br><br>
        @if(Auth::check() && auth()->user()->name !== $group->founder) 
          @if(!$group->users->contains(Auth::user()))           
              <a href="/group/{{ $group->id }}/user/{{ auth()->id() }}" class="btn btn-primary">Join Group</a>           
          @else
            <a href="/group/{{ $group->id }}/user/{{ auth()->id() }}/leave" class="btn btn-danger leaveGroup">Leave Group</a>
          @endif
        @endif

        </p>
      </div>
      <div class="clearfix"></div>
    @endforeach
    <div class="text-center">
      {{ $groups->links() }}
    </div>
    
</div>
@endsection