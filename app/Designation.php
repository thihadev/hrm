<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    // protected $table = "designations";

    // protected $guarded = [];

    protected $table = "designations";


    protected $fillable = ["name"];

    public function Employee() 
    {
    	return $this->hasMany("App\Employee", "name", "id");
    }
}
