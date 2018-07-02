<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cache;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'access'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function friendOfMine()
    {
        return $this->belongsToMany('App\User','friends' ,'user_id', 'friend_id');
    }

    public function friendOf()
    {
        return $this->belongsToMany('App\User','friends' ,'friend_id', 'user_id');
    }

    public function friends()
    {
        return $this->friendOfMine->merge($this->friendOf);
    }

    public function roles() {
      // return $this->belongsToMany('App\Role')
        return $this->belongsToMany(Role::class ,'user_roles');
    }

    public function role () {

        return $this->belongsToMany(Role::class);
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function departments() 
    {
        return $this->belongsToMany(Department::class , 'dept_users');
    }

    public function messages()
    {
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

    public function isOnline()
    {
        return Cache::has('user-is-online-'. $this->id);
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
