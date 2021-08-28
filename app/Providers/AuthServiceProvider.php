<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Providers\AdminGuard;
use App\Providers\DoctorGuard;
use App\Providers\GuardProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->app->bind('App\Models\User',function($app){
            return new User();
        });
        $this->app->bind("App\Providers\GuardProvider",function($app){
            return new GuardProvider($app->make("App\Models\User"));
            
        });

        Auth::extend("doctor",function($app,$name, array $config){
            return new DoctorGuard($app->make("App\Providers\GuardProvider"),$app->make("Illuminate\Http\Request"));
        });
        
        Auth::extend("admin",function($app,$name, array $config){
            return new AdminGuard($app->make("App\Providers\GuardProvider"),$app->make("Illuminate\Http\Request"));
        });
        //
    }
}
