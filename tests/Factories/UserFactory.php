<?php

namespace Laravie\Authen\Tests\Factories;

use Illuminate\Support\Str;
use Laravie\Authen\Tests\Fixtures\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Laravie\Authen\Tests\Fixtures\User>
 */
class UserFactory extends \Orchestra\Testbench\Factories\UserFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'username' => $this->faker->unique()->userName(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
};
