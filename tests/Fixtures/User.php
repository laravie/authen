<?php

namespace Laravie\Authen\Tests\Fixtures;

use Illuminate\Foundation\Auth\User as Eloquent;
use Laravie\Authen\AuthenUser;

class User extends Eloquent
{
    use AuthenUser;

    /**
     * Get the name of the unique identifier for the user.
     */
    public function getAuthIdentifiersName(): array
    {
        return ['email', 'username'];
    }
}
