<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Like;

class PostController extends Controller
{
    public function store(){
    	$this->validate(request(),[
    		'body' => 'required'
    	]);

    	$post = new Post;
    	$post->body = request('body');
    	$post->user_id = auth()->id();
    	$post->save();

    	return redirect()->back();
    }

    public function storeLike(Post $post){
        // check if the post has already been liked by the signed in user
        if(count(Like::where([['user_id', auth()->id()], ['post_id', $post->id]])->get())){
           return redirect()->back()->withErrors(['message' => 'You have already liked this post!']);
        }

        $like = new Like;
        $like->user_id = auth()->id();
        $post->likes()->save($like);

        return redirect()->back();
    }

    public function destroyLike(Post $post){
       $like = Like::where([['post_id', $post->id],['user_id', auth()->id()]])->get()[0];
       $like->delete();

       return redirect()->back();
    }
}
