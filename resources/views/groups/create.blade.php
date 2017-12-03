@extends('master.master')

@section('main-content')
@include('inc.errors')
@include('flash::message')

<div class="groups">
    <h1 class="page-header">Make a new group</h1>

     <form method="POST" action="/group/store" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name">Name: </label>
            <input type="text" class="form-control" id='name' name="name" >
        </div>
        <div class="form-group">
            <label for="description">Description: </label>
            <textarea class="form-control" id='description' name="description" ></textarea> 
        </div>
        <div class="form-group">
          <label for="file_upload">Upload Picture</label>
          <input type="file" name="file_upload">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Publish</button>
        </div>
    </form>
</div>
@endsection