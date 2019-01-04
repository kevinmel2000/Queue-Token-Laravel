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
        'App\Models\Department' => 'App\Policies\DepartmentPolicy',
        'App\Models\Counter' => 'App\Policies\CounterPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Setting' => 'App\Policies\SettingsPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
