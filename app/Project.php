<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ["p_name","client_id", "employee_id","start_date","end_date"];

    public function employee () 
    {
    	return $this->belongsTo("App\Employee");
    }

    public function client()
    {
    	return $this->belongsTo("App\Client");
    }
}
