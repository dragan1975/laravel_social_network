<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegistrationController extends Controller
{
    public function create(){
    	return view('registration.create');
    }

    public function store(){
    	
    	$this->validate(request(), [
    		'name' => 'required',
    		'email' => 'required|email',
    		'password' => 'required|confirmed'
    	]);

    	$user = User::create(request(['name', 'email', 'password']));

    	

    	\Auth::login($user);

    	flash($user->name . ' please, finish your registration by filling out the form in your profile. By doing so, you will be listed as a member of this network.')->warning();


    	return redirect()->home();
    }
}
