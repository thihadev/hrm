<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
	protected $table = "departments";


    protected $fillable = ["name"];

    public function Employee() 
    {
    	return $this->hasMany("App\Employee", "name", "id");
    }

    public function users ()
    {
    	return $this->belongsToMany(User::class, 'dept_users');
    }
}
