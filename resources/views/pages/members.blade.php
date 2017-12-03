@extends('master.master')

@section('main-content')

 @include('inc.errors')
 @include('flash::message')

<div class="members">
  <h1 class="page-header">Members</h1>
  @foreach($members as $member)
    @continue($member->id == Auth::id())
    <div class="row member-row">
      <div class="col-md-3">
        <img src="{{ str_replace('public','storage',asset($member->imagePath)) }}" class="img-thumbnail" alt="">
        <div class="text-center">
          {{$member->name}}
        </div>
      </div>
      @if(Auth::check())
        <div class="col-md-3">

          @if(count(\DB::table('friends')->where([['user_id', Auth::id()],['friend_id', $member->id],['status',false]])->get()))
            <p><a href="#" class="btn btn-success btn-block"><i class="fa fa-users"></i> Request Sent</a></p>

          @elseif(count(\DB::table('friends')->where([['user_id', Auth::id()],['friend_id', $member->id],['status',true]])->get()))
            <p><a href="#" class="btn btn-success btn-block"><i class="fa fa-users"></i> It's Friend</a></p>

          @else
            <p><a href="/user/{{ Auth::id() }}/request/{{ $member->id }}" class="btn btn-success btn-block"><i class="fa fa-users"></i> Add Friend</a></p>
          @endif
          
        </div>
        <div class="col-md-3">
          <p><a href="#" class="btn btn-default btn-block sendMessageButton" ><i class="fa fa-envelope"></i> Send Message</a></p>
        </div>        

      @endif
      <div class="col-md-3">
        <p><a href="/profile/{{ $member->id }}" class="btn btn-primary btn-block"><i class="fa fa-edit"></i> View Profile</a></p>
      </div>

      <div class="row hide">
        <div class="col-md-12">
          <form class="formMessage" method="post" action="/messages/{{ $member->id }}/send/{{ auth()->id() }}">
             {{csrf_field()}}
            <div class="form-group">
              <label>Message:</label>
              <textarea name="body" class="form-control" id="body"></textarea>
            </div>
              <input type="hidden" class="member" value="{{ $member->id }}">
              <input type="hidden" class="sender" value="{{ auth()->id() }}"> 
            <button type="submit" class="btn btn-default">Send message</button> 
            <button type="button" class="btn btn-default cancelSendForm pull-right">Cancel</button> 
          </form>          
        </div>
      </div>
    </div>
  @endforeach

  <div class="text-center">
    {{ $members->links() }}
  </div>
  
</div>
@endsection