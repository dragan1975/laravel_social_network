<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SessionsController extends Controller
{
    public function store(){
    	if (\Auth::attempt(request(['email', 'password']))) {
            // Authentication passed...
            return redirect()->back();
        }
        if (! User::pluck('email')->contains(request('email'))){
            return redirect()->home()->withErrors(['authAtemptError' => 'There is no user registered with ' . request('email') .' email!']);
        }
        return redirect()->home()->withErrors(['authAtemptError' => 'There was a problem with authentication!']);
     }  

    public function destroy(){
    	auth()->logout();
    	return redirect()->home();
    }


}
