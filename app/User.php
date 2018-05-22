<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles() {
      // return $this->belongsToMany('App\Role')
        return $this->belongsToMany(Role::class ,'role_users');
    }

    public function Message() {
        return $this->hasMany(Message::class);
    }

    public function hasAccess(array $permissions) : bool
    {
        foreach ($this->roles as $role) {
           if($role->hasAccess($permissions)) 
           {
            return true;
           }
        }
        return false;
    }

    public function hasPermission($permission) {
        if($this->roles() != null) 
        {
            $user_permissions = $this->roles()->first()->permissions;
            if(array_key_exists($permission, $user_permissions))
            {
                if($user_permissions[$permission]) 
                {
                    return true;
                } else {
                    return false;
                        } 
                } else {
                    return false;
            }
            
        }
        return false;
    }

//     public function authorizeRoles($roles)
// {
//   if ($this->hasAnyRole($roles)) {
//     return true;
//   }
//   abort(401, 'This action is unauthorized.');
// }
// public function hasAnyRole($roles)
// {
//   if (is_array($roles)) {
//     foreach ($roles as $role) {
//       if ($this->hasRole($role)) {
//         return true;
//       }
//     }
//   } else {
//     if ($this->hasRole($roles)) {
//       return true;
//     }
//   }
//   return false;
// }
// public function hasRole($role)
// {
//   if ($this->roles()->where('name', $role)->first()) {
//     return true;
//   }
//   return false;
// }


}
