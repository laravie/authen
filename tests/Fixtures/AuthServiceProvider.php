<?php

namespace Laravie\Authen\Tests\Fixtures;

use Laravie\Authen\BootAuthenProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    use BootAuthenProvider;

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->bootAuthenProvider();
    }
}
