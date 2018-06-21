<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\UserRole;
use App\Department;
use App\Designation;
use App\Payroll;

class Employee extends Model
{

    protected $fillable = ["photo", "name", "email", "gender","nrc", "phone", "address", "dateofbirth", "department_id", "designation_id", "joined", "salary"];


	// public function Department() 
 //    {
 //    	return $this->belongsTo("App\Department", "id", "name");
 //    }

     public function userrole()
    {
        return $this->hasOne('App\UserRole', 'user_id', 'id');
    }

       public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payrolls(){
        return $this->hasMany("App\Payroll");
    }

}
