<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

	protected $fillable = ['name', 'slug' , 'permissions'];
	protected $casts = [
    	'permissions' => 'array'
    ];

    public function users() {
    	// return $this->belongsToMany('App\User')
    	return $this->belongsToMany(User::class , 'user_roles');
    				// ->withTimestamps();
    }

    public function user () {
    	return $this->hasOne(User::class);
    }
}
