<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use App\Profile;
use App\MyLibrary\States;

class UserController extends Controller
{
    public function show(User $user){
        $states = States::states();

        $profile_info = $user->profile;

        $groups = \DB::table('users')->join('groups','users.name','=','groups.founder')
                                     ->where(['users.id' => $user->id])
                                     ->select('groups.name', 'groups.id')
                                     ->get();        

        $friends_ids = \DB::table('users')->join('friends', 'users.id', 'friends.friend_id')
                                    ->where([['friends.friend_id', $user->id], ['status', true]])
                                    ->select('friends.user_id')
                                    ->get();
        $friends = [];               
        foreach($friends_ids as $id){
          $friend = User::find($id->user_id);
          array_push($friends, $friend);
        }
        $friends = array_unique($friends);


        $requests_ids = \DB::table('users')->join('friends', 'users.id', 'friends.friend_id')
                                    ->where([['friends.friend_id', $user->id], ['status', false]])
                                    ->select('friends.user_id')
                                    ->get();
        $users_req = [];               
        foreach($requests_ids as $id){
          $request_user = User::find($id->user_id);
          array_push($users_req, $request_user);
        }


    if(empty($profile_info)){
      return view('users.profile_empty', compact('user', 'states', 'groups', 'users_req', 'friends'));
    }
    	
    return view('users.profile_edit', compact('user', 'states', 'profile_info', 'groups', 'users_req', 'friends'));
    }

    public function showWallPosts(User $user){
      if(auth()->user() != $user){
        flash('You are NOT authorized to perform that action!');
        return redirect('/');
      }
      $wall_posts = $user->posts->sortByDesc('created_at');
      return view('users.profile_wall_posts', compact('user', 'wall_posts'));
    }



    public function storeProfileInfo(Request $request, $id){
    	$this->validate(request(), [
    		'city' => 'required',
    		'state' => 'required',
    		'dob' => 'required|date',
    		'gender' => 'required|min:1|max:1',
    		'file_upload' => 'required|image|max:1999'
    	]);

    	// Get filename with extension
	      $filenameWithExt = $request->file('file_upload')->getClientOriginalName();

	      // Get just the filename
	      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

	      // Get extension
	      $extension = $request->file('file_upload')->getClientOriginalExtension();

	      // Create new filename
	      $filenameToStore = $filename.'_'.time().'.'.$extension;

	      // Uplaod image
	      $path= $request->file('file_upload')->storeAs('public/profile_images', $filenameToStore);

          $profile = new Profile;
          $profile->city = $request->city;
          $profile->state = $request->state;
          $profile->DOB = $request->dob;
          $profile->gender = $request->gender;
          $profile->imagePath = $path;
          $profile->user_id = $id;
          $profile->save();


    	return redirect()->home()->with(['message' => 'You have updated your profile!']);
    }

    public function editProfileInfo(Request $request, $id){
        $this->validate(request(), [
            'city' => 'required',
            'state' => 'required',
            'dob' => 'required|date',
            'gender' => 'required|min:1|max:1',
            'file_upload' => 'required|image|max:1999'
        ]);

        // Get filename with extension
      $filenameWithExt = $request->file('file_upload')->getClientOriginalName();

      // Get just the filename
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

      // Get extension
      $extension = $request->file('file_upload')->getClientOriginalExtension();

      // Create new filename
      $filenameToStore = $filename.'_'.time().'.'.$extension;

      // Uplaod image
      $path= $request->file('file_upload')->storeAs('public/profile_images', $filenameToStore);

      // $profile = Profile::find($id);
      $profile = User::find($id)->profile;

      $profile->city = $request->city;
      $profile->state = $request->state;
      $profile->DOB = $request->dob;
      $profile->gender = $request->gender;
      $profile->imagePath = $path;
      $profile->user_id = $id;
      $profile->update();


      return redirect()->home()->with(['message' => 'You have updated yor profile succesfully.']);

    }

    public function requestFriendship(User $user, $id){

      \DB::table('friends')->insert([
        'user_id' => $user->id,
        'friend_id' => $id,
        'status' => false,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now() 
      ]);

      return redirect()->back();

    }

    public function acceptFriendship(User $user, $id){

     \DB::table('friends')->where([['user_id', $id],['friend_id',$user->id]])
                           ->update(['status' => true]);

      \DB::table('friends')->insert([
        'user_id' => $user->id,
        'friend_id' => $id,
        'status' => true,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now() 
      ]);                

      return redirect()->back();

    }

    public function refuseFriendship(User $user, $id){

     \DB::table('friends')->where([['user_id', $id],['friend_id',$user->id]])
                           ->delete();

      return redirect()->back();

    }

    public function showMessages(User $user){
      if(auth()->user() != $user){
        flash('You are NOT authorized to perform that action!');
        return redirect('/');
      }
      return view('users.messages', compact('user'));
    }
    

    public function postMessage(User $user, $sender){

      $this->validate(request(),[
        'body' => 'required'
      ]);

      \DB::table('messages')->insert([
        'user_id' => $user->id,
        'sender' => $sender,
        'body' => request('body'),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now() 
      ]);

      flash('You have just sent a message to ' . $user->name . '!');

       return redirect()->back();

    } 
}
