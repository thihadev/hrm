<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['c_name','c_email','c_phone','c_address','c_web'];

    public function project()
    {
    	return $this->belongsToMany("App\Project");
    }

    public function employee () 
    {
    	return $this->belongsTo("App\Employee");
    }
}
