<?php

namespace Laravie\Authen;

use Illuminate\Support\Facades\Auth;

trait BootAuthenProvider
{
    /**
     * Register authen user provider.
     *
     * @return void
     */
    protected function bootAuthenProvider(): void
    {
        Auth::provider('authen', static function ($app, array $config) {
            return new AuthenUserProvider($app->make('hash'), $config['model']);
        });
    }
}
