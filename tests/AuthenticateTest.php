<?php

namespace Laravie\Authen\Tests;

use Laravie\Authen\Authen;
use Illuminate\Support\Facades\Auth;
use Laravie\Authen\Tests\Fixtures\User;

class AuthenticateTest extends TestCase
{
    /** @test */
    public function itCanAuthenticateUserWithUsername()
    {
        $user = factory(User::class)->create();

        $this->assertTrue(Auth::validate(['identifier' => $user->username, 'password' => 'secret']));
    }

    /** @test */
    public function itCanAuthenticateUserWithCustomIdentifier()
    {
        $user = factory(User::class)->create();

        Authen::setIdentifierName('username');

        $this->assertTrue(Auth::validate(['username' => $user->username, 'password' => 'secret']));
        $this->assertFalse(Auth::validate(['email' => $user->username, 'password' => 'secret']));
    }

    /** @test */
    public function itCantSetEmptyIdentifierName()
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage("Identifier shouldn't be empty.");

        Authen::setIdentifierName('');
    }

    /** @test */
    public function itCantPasswordAsIdentifierName()
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage('Identifier [password] is not allowed!');

        Authen::setIdentifierName('password');
    }
}
