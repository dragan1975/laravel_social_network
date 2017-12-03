@extends('master.master')

@section('main-content')

@include('inc.errors')

<h1 class="page-header">{{ $user->name }}</h1>
  <div class="row">
    <div class="col-md-4">
      <img src="{{ str_replace('public', 'storage', asset($profile_info->imagePath)) }}" class="img-thumbnail" alt="">
    </div>
    <div class="col-md-8">
      <ul>
        <li><strong>Name:</strong>{{ $user->name }}</li>
        <li><strong>Email:</strong>{{ $user->email }}</li>
        <li><strong>City:</strong>{{ $profile_info->city }}</li>
        <li><strong>State:</strong>{{ $profile_info->state }}</li>
        <li><strong>Gender:</strong>{{ $profile_info->gender == 'm' ? 'male' : 'female' }}</li>
        <li><strong>DOB:</strong>{{ $profile_info->DOB }}</li>
      </ul>
    </div>
  </div><br><br>
  @include('inc.profile.profile_buttons_part')

  @include('inc.profile.requests_part')

  @include('inc.profile.groups_part')

  @if(auth()->id() == $user->id)
  <div class="row">
    <div class="col-md-12">
       <a name="editProfile"><div class="panel panel-default"></a>
        <div class="panel-heading">
         <h3 class="panel-title">Edit Profile</h3>
        </div>
        <div class="panel-body">
          <form method="POST" action="/profile/edit/{{ auth()->id() }}" enctype="multipart/form-data">
            
            {{csrf_field()}}
            <input name="_method" type="hidden" value="PUT">

            <div class="form-group">
              <label>City:</label>
              <input type="text" name="city" class="form-control" value="{{ $profile_info->city }}">
            </div>
            
            <div class="form-group">
              <label for="state">State:</label>
              <select class="form-control" name="state">
                @foreach($states as $state)
                  <option value={{ $state }} {{ $profile_info->state == $state ? 'selected' : '' }}>{{ $state }}</option>
                @endforeach
              </select>            
            </div>
            
            <div class="form-group">
              <label>Gender:</label>
              <div class="radio">
                  <label><input type="radio" name="gender" value="f" {{ $profile_info->gender == 'f' ? 'checked' : '' }}>Female</label>
                </div>
                <div class="radio">
                  <label><input type="radio" name="gender" value="m" {{ $profile_info->gender == 'm' ? 'checked' : '' }}>Male</label>
                </div>
            </div>
            
            <div class="form-group">
              <label>DOB:</label>
              <input type="date" name="dob" class="form-control" value="{{ $profile_info->DOB}}">
            </div>
            
            <div class="form-group">
              <label for="file_upload">Upload Picture File</label>
              <input type="file" name="file_upload">
            </div>
            
            <button class="btn btn-primary">Submit</button>

          </form>
        </div>
      </div>
    </div>
  </div>
  @endif
  
@endsection