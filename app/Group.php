<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public static function latestGroups(){
    	return static::latest()->limit(3)->get();
    }
}
