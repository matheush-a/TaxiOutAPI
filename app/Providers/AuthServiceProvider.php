<?php

namespace App\Providers;

use App\Models\Car;
use App\Policies\CarPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Car::class => CarPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
