<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class CommentController extends Controller
{
    public function store(Post $post){
    	$this->validate(request(),[
    		'body' => 'required'
    	]);

    	$comment = new Comment;
    	$comment->body = request('body');
    	$comment->user_id = auth()->id();

    	$post->comments()->save($comment);

    	return redirect()->back();
    }
}
