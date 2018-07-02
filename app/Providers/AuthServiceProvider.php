<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('delete-info', function($user, $role) {
            if ($user->hasPermissions('delete-info')) {
                if($user->id == $role->user_id || $user->is_admin ) {
                    return true;
                }

            }
        });

        Gate::define('update-info', function($user, $role) {
            if ($user->hasPermissions('update-info')) {
                if($user->id == $role->user_id || $user->is_admin ) {
                    return true;
                }

            }
        });

        Gate::define('create-info', function($user, $role) {
            if ($user->hasPermissions('create-info')) {
                if($user->id == $role->user_id || $user->is_admin ) {
                    return true;
                }

            }
        });

        Gate::define('show-info', function($user, $role) {
            if ($user->hasPermissions('show-info')) {
                if($user->id == $role->user_id || $user->is_admin ) {
                    return true;
                }

            }
            return false;
        });

        // Gate::define('show-dept', function($user, $dept) {
        //     if($user->hasPermissions('show-dept')) {
        //         if($user->id == $dept->dept_id ) {
        //             return true;
        //         }
        //     }
        //     return false;
        // });
    }
}
