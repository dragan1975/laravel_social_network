@extends('master.master')

@section('main-content')

@include('flash::message')

<div class="groups">
    <h1 class="page-header">Edit group</h1>

     <form method="POST" action="/group/{{$group->id}}/edit" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name">Name: </label>
            <input type="text" class="form-control" id='name' name="name" value="{{ $group->name }}">
        </div>
        <div class="form-group">
            <label for="description">Description: </label>
            <textarea class="form-control" id='description' name="description" >{{ $group->description }}"</textarea> 
        </div>
        <div class="form-group">
          <label for="file_upload">Upload New Picture</label>
          <input type="file" name="file_upload">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Send Changes</button>
        </div>
    </form>
</div>
@endsection