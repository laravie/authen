<?php

namespace Laravie\Authen\Tests;

use Laravie\Authen\Authen;
use Illuminate\Support\Facades\Auth;
use Laravie\Authen\Tests\Stubs\User;

class AuthenticateTest extends TestCase
{
    /** @test */
    public function it_can_authenticate_user_with_username()
    {
        $user = factory(User::class)->create();

        $this->assertTrue(Auth::validate(['identifier' => $user->username, 'password' => 'secret']));
    }

    /** @test */
    public function it_can_authenticate_user_with_custom_identifier()
    {
        $user = factory(User::class)->create();

        Authen::setIdentifierName('username');

        $this->assertTrue(Auth::validate(['username' => $user->username, 'password' => 'secret']));
        $this->assertFalse(Auth::validate(['email' => $user->username, 'password' => 'secret']));
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Identifier shouldn't be empty.
     */
    public function it_cant_set_empty_identifier_name()
    {
        Authen::setIdentifierName('');
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Identifier [password] is not allowed!
     */
    public function it_cant_password_as_identifier_name()
    {
        Authen::setIdentifierName('password');
    }
}
