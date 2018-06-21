<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $guarded = [];

    public function roles()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
}
