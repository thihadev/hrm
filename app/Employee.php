<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Department;
use App\Designation;

class Employee extends Model
{

    protected $fillable = ["avatar", "name", "email", "password", "age", "phone", "address", "dateofbirth", "department_id", "designation_id",  "joined"];

       protected $hidden = [
        'password', 'remember_token',
    ];

public function Department() 
    {
    	return $this->belongsTo("App\Department", "id", "name");
    }
}
