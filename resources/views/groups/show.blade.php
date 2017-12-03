@extends('master.master')

@section('main-content')
@include('inc.errors')
@include('flash::message')

<div class="groups">
    <h1 class="page-header">{{ $group->name }}</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default post">
                <div class="panel-heading">{{ $group->founder }}</div>
                    <div class="panel-body"> 
                    <img src="{{ str_replace('public','storage',asset($group->imagePath)) }}" class="img-circle" alt="">
                    <p>{{ $group->description }}</p>                        
                    </div>
               </div> 
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">            
        @if(Auth::check() && auth()->user()->name !== $group->founder)

          @if(!$group->users->contains(Auth::user()))           
              <a href="/group/{{ $group->id }}/user/{{ auth()->id() }}" class="btn btn-default">Join Group</a>           
          @else
            <a href="/group/{{ $group->id }}/user/{{ auth()->id() }}/leave" class="btn btn-danger">Leave Group</a>
          @endif

        @endif

      @if(Auth::check() && auth()->user()->name == $group->founder)
       <a href="/group/{{ $group->id }}/edit" class="btn btn-danger">Edit Group</a>
       <a href="/group/{{ $group->id }}/delete" class="btn btn-danger pull-right">Delete Group</a>
      @endif

        
        </div>
    </div>

    @if(count($group->users) > 0)
    <div class="row">
        <div class="col-md-8">
            <h2>Members</h2>
            <ul class="list-group">
                @foreach($group->users as $member)
                <li class="list-group-item"><a href="/profile/{{ $member->id }}">{{ $member->name }} {{ $group->founder == $member->name ? ' - the founder' : '' }}</a>
                    @if(Auth::check() && Auth::user()->name === $group->founder)
                        @if($group->founder !== $member->name)
                        <a href="/group/{{ $group->id }}/user/{{ $member->id }}/remove"><span class="glyphicon glyphicon-remove pull-right"></span></a>
                        @endif
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
</div>
@endsection