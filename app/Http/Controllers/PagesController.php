<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Group;


class PagesController extends Controller
{
    public function index(){
        $posts = Post::latest()->paginate(3);
    	return view('pages.home', compact('posts'));
    }

    public function members(){
        $members = \DB::table('users')
                    ->join('profiles', 'users.id', '=', 'profiles.user_id')
                    ->select('users.*','profiles.*')
                    ->select('users.id', 'users.name', 'profiles.imagePath')
                    ->paginate(3);
    	return view('pages.members', ['members'=>$members]);
    }

    public function groups(){
        $groups = Group::latest()->paginate(4);
        foreach($groups as $group){
            if(strlen($group->description) > 150)
                $group->description = substr($group->description, 0, 150) . '...';
        }
    	return view('pages.groups', compact('groups'));
    }
}
