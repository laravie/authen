<?php

namespace Laravie\Authen\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\Concerns\WithLaravelMigrations;
use Orchestra\Testbench\Concerns\WithWorkbench;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;
    use WithLaravelMigrations;
    use WithWorkbench;

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function defineEnvironment($app)
    {
        $config = $app->make('config');

        $config->set([
            'auth.providers.users' => [
                'driver' => 'authen',
                'model' => \Workbench\App\Models\User::class,
            ],
        ]);
    }
}
