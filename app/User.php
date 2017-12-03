<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function messages(){
        return $this->hasMany('App\Message');
    }

    public function profile(){
        return $this->hasone('App\Profile');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }

    public function groups()
    {
        return $this->belongsToMany('App\Group')->withTimestamps();
    }

    public static function randomMembers(){
        return \DB::table('users')->join('profiles', 'users.id','=','profiles.user_id')
                           ->select('users.id','profiles.imagePath')
                           ->inRandomOrder()
                           ->take(6)
                           ->get();
    }
}
