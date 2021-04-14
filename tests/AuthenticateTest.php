<?php

namespace Laravie\Authen\Tests;

use Illuminate\Support\Facades\Auth;
use Laravie\Authen\Authen;
use Laravie\Authen\Tests\Factory\UserFactory;

class AuthenticateTest extends TestCase
{
    /** @test */
    public function it_can_authenticate_user_with_username()
    {
        $user = UserFactory::new()->create();

        $this->assertTrue(Auth::validate(['identifier' => $user->username, 'password' => 'password']));
    }

    /** @test */
    public function it_can_authenticate_user_with_custom_identifier()
    {
        $user = UserFactory::new()->create();

        Authen::setIdentifierName('username');

        $this->assertTrue(Auth::validate(['username' => $user->username, 'password' => 'password']));
        $this->assertFalse(Auth::validate(['email' => $user->username, 'password' => 'password']));
    }

    /** @test */
    public function it_cant_set_empty_identifier_name()
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage("Identifier shouldn't be empty.");

        Authen::setIdentifierName('');
    }

    /** @test */
    public function it_cant_password_as_identifier_name()
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage('Identifier [password] is not allowed!');

        Authen::setIdentifierName('password');
    }
}
