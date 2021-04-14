<?php

namespace Laravie\Authen\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Laravie\Authen\AuthenServiceProvider::class,
            \Laravie\Authen\Tests\Fixtures\AuthServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application   $app
     *
     * @return void
     */
    protected function defineEnvironment($app)
    {
        $config = $app->make('config');

        $config->set([
            'auth.providers.users' => [
                'driver' => 'authen',
                'model' => \Laravie\Authen\Tests\Fixtures\User::class,
            ],
        ]);
    }

    /**
     * Define database migrations.
     *
     * @return void
     */
    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom([
            '--database' => 'testing',
            '--path' => realpath(__DIR__.'/migrations'),
        ]);
    }
}
