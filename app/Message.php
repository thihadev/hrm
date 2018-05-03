<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $fillable = ['message'];

    public function User() 
    {
    	return $this->belongsTo(User::class);
    }

 //    public function scopeMostRecent($query) 
 //    {
	// 	return $query->orderBy('created_at', 'desc')->limit(10);
	// }
}
