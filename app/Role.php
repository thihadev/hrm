<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users() {
    	// return $this->belongsToMany('App\User')
    	return $this->belongsToMany('App\User','role_users', 'user_id', 'role_id');
    				// ->withTimestamps();
    }
}
