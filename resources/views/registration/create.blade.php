@extends('master.master')

@section('main-content')
  <div class="col-sm-8 blog-main">
     <h1>Register</h1>

     <form method="POST" action="/register">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name">Name: </label>
            <input type="text" class="form-control" id='name' name="name" >
        </div>
        <div class="form-group">
            <label for="email">Email: </label>
            <input type="email" class="form-control" id='email' name="email" >
        </div>
         <div class="form-group">
            <label for="password">Password: </label>
            <input type="password" class="form-control" id='password' name="password" >
        </div>
        <div class="form-group">
            <label for="password_confirmation">Password confirmation: </label>
            <input type="password" class="form-control" id='password_confirmation' name="password_confirmation" >
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </form>

    <div class="form-group">
        @include('inc.errors')
    </div>
    
  </div>
@endsection