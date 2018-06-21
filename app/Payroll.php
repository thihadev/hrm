<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Employee;

class Payroll extends Model
{
    protected $fillable = ['employee_id', 'over_time', 'hours', 'rate', 'gross'];

    public function employee () 
    {
    	return $this->belongsToMany("App\Employee");
    }


    public function grossPay(){
		$calc = 0;
		if(!$this->over_time){
			return $this->gross = $this->employee->salary;
		}
		if($this->over_time){
			$calc = $this->hours * $this->rate;
			return $this->gross = $calc + $this->employee->salary;
		}
		return $this->gross = 0;
	}
}
