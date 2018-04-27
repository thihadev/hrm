<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Department;
use App\Designation;

class Employee extends Model
{

    protected $fillable = ["photo", "name", "email", "age", "phone", "address", "dateofbirth", "department_id", "designation_id", "joined"];


public function Department() 
    {
    	return $this->belongsTo("App\Department", "id", "name");
    }
}
