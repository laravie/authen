<?php

namespace Laravie\Authen\Tests\Stubs;

use Laravie\Authen\AuthenUser;
use Illuminate\Foundation\Auth\User as Eloquent;

class User extends Eloquent
{
    use AuthenUser;

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return array
     */
    public function getAuthIdentifiersName()
    {
        return ['email', 'username'];
    }
}
