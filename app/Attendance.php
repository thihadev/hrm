<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ["att_employee_id", "date", "attend"];

    public function employee () 
    {
    	$this->belongsToMany("App\Employee");
    }
}
