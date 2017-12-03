<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dobble Social Network</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
  </head>

  <body>

  <header>
    <div class="container">
      <img src="{{ asset('img/logo.png') }}" class="logo" alt="">
      @if(Auth::check())
      <div class="pull-right">
        <a href="/profile/{{Auth::user()->id}}"><button class="btn btn-default">{{ Auth()->user()->name }}</button></a> 
        <a href="/logout"><button class="btn btn-default" >Sign out</button></a>          
      </div>
     
      @else
        <form class="form-inline" method="POST" action="/login">
          {{csrf_field()}}
          <div class="form-group">
            <input type="email" class="form-control" placeholder="Enter email" name="email">
          </div>
          <div class="form-group">
            <input type="password" class="form-control"  placeholder="Password" name="password">
          </div>
          <button type="submit" class="btn btn-default">Sign in</button><br>            
        </form>
      @endif
    </div>
  </header>

@include('master.nav')