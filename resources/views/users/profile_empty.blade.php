@extends('master.master')

@section('main-content')

@include('inc.errors')

<h1 class="page-header">{{ $user->name }}</h1>
  <div class="row">
    <div class="col-md-4">
      <img src="{{ asset('img/user.png') }}" class="img-thumbnail" alt="">
    </div>
    <div class="col-md-8">
      <ul>
        <li><strong>Name:</strong>{{ $user->name }}</li>
        <li><strong>Email:</strong>{{ $user->email }}</li>
        <li><strong>City:</strong></li>
        <li><strong>State:</strong></li>
        <li><strong>Gender:</strong></li>
        <li><strong>DOB:</strong></li>
      </ul>
    </div>
  </div><br><br>
  @include('inc.profile.profile_buttons_part')
  
  @include('inc.profile.requests_part')

  @include('inc.profile.groups_part')

   @if(auth()->id() == $user->id)
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
           <a name="editProfile"><h3 class="panel-title">Fill Up Profile Info</h3></a>
        </div>
        <div class="panel-body">
          <form method="POST" action="/profile/{{ auth()->id() }}" enctype="multipart/form-data">
              {{csrf_field()}}
            <div class="form-group">
              <label>City:</label>
              <input type="text" name="city" class="form-control" >
            </div>
            <div class="form-group">
              <label for="state">State:</label>
              <select class="form-control" name="state">
                @foreach($states as $state)
                  <option value={{ $state }} >{{ $state }}</option>
                @endforeach
              </select>            
            </div>
            <div class="form-group">
              <label>Gender:</label>
              <div class="radio">
                  <label><input type="radio" name="gender" value="f" checked>Female</label>
                </div>
                <div class="radio">
                  <label><input type="radio" name="gender" value="m" >Male</label>
                </div>
            </div>
            <div class="form-group">
              <label>DOB:</label>
              <input type="date" name="dob" class="form-control" >
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