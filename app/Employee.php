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


	public function department() 
    {
    	return $this->belongsTo("App\Department", "id", "name");
    }
        public function designation() 
    {
        return $this->belongsTo("App\Designation", "id", "name");
    }

    public function userrole()
    {
        return $this->hasOne('App\UserRole', 'user_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payroll (){
        return $this->belongsTo("App\Payroll", 'employee_id','id');
    }

    public function attendance () 
    {
        return $this->belongsTo("App\Attendance");
    }

    public function project()
    {
        return $this->belongsToMany("App\Project");
    }

}
