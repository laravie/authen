<?php

namespace Laravie\Authen;

use Illuminate\Support\ServiceProvider;

class AuthenServiceProvider extends ServiceProvider
{
    use BootAuthenProvider;

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootAuthenProvider();
    }
}
