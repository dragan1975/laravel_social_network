<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\User;

class GroupController extends Controller
{

    public function create(){
        return view ('groups.create');
    }

    public function show(Group $group){      
      return view('groups.show', compact('group'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required'
        ]);

        $group = new Group;
        $group->name  = $request->name;
        $group->description  = $request->description;
        $group->founder = auth()->user()->name;

        if(!empty($request->file('file_upload'))){
            // Get filename with extension
          $filenameWithExt = $request->file('file_upload')->getClientOriginalName();

          // Get just the filename
          $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

          // Get extension
          $extension = $request->file('file_upload')->getClientOriginalExtension();

          // Create new filename
          $filenameToStore = $filename.'_'.time().'.'.$extension;

          // Uplaod image
          $path= $request->file('file_upload')->storeAs('public/groups', $filenameToStore);

          $group->imagePath = $path;
        }

        $group->save();

        $this->storeUser($group, auth()->user());

        return redirect('/groups');

    }

    public function edit(Group $group){
      if(auth()->user()->name !== $group->founder){
        flash('You are NOT authorized to perform that action!');
        return redirect('/');
      }

      return view('groups.edit', compact('group'));
    }

    public function editGroup(Request $request, Group $group){
      $this->validate($request,[
            'name' => 'required',
            'description' => 'required'
        ]);

      $group->name  = $request->name;
      $group->description  = $request->description;
      $group->founder = auth()->user()->name;

      if(!empty($request->file('file_upload'))){
          // Get filename with extension
        $filenameWithExt = $request->file('file_upload')->getClientOriginalName();

        // Get just the filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        // Get extension
        $extension = $request->file('file_upload')->getClientOriginalExtension();

        // Create new filename
        $filenameToStore = $filename.'_'.time().'.'.$extension;

        // Uplaod image
        $path= $request->file('file_upload')->storeAs('public/groups', $filenameToStore);

        $group->imagePath = $path;
      }

      $group->update();

      return redirect('/group/'.$group->id);
    }


    public function delete(Group $group){

      $group->users()->detach();

      $group->delete();

      return redirect('/profile/' . auth()->id());

    }

    public function storeUser(Group $group, User $user){
      if(auth()->user() != $user){
        flash('You are NOT authorized to perform that action!');
        return redirect('/');
      }
    	$group->users()->attach($user);

    	flash('You have joined ' . $group->name . '!')->success();

    	return redirect()->back();
    }

    public function destroyUser(Group $group, User $user){

      if(auth()->user() != $user){
        flash('You are NOT authorized to perform that action!');
        return redirect('/');
      }

    	$group->users()->detach($user);

    	flash('You have left ' . $group->name . '!')->warning();

    	return redirect()->back();
    }

    public function founderRemoveMember(Group $group, User $user){

      if(auth()->user()->name != $group->founder){
        flash('You are NOT authorized to perform that action!');
        return redirect('/');
      }

      $group->users()->detach($user);

      flash('You have removed '. $user->name .' from ' . $group->name . '!')->warning();

      return redirect()->back();
    }
}
