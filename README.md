User Authentication Identifiers for Laravel
==============

[![Latest Stable Version](https://poser.pugx.org/laravie/authen/v/stable)](https://packagist.org/packages/laravie/authen)
[![Total Downloads](https://poser.pugx.org/laravie/authen/downloads)](https://packagist.org/packages/laravie/authen)
[![Latest Unstable Version](https://poser.pugx.org/laravie/authen/v/unstable)](https://packagist.org/packages/laravie/authen)
[![License](https://poser.pugx.org/laravie/authen/license)](https://packagist.org/packages/laravie/authen)

Imagine you need to login a user with either "email", "username" or "phone number" just like how Facebook allows it. This is not possible with Laravel since you're limited to only one unique username/identifier key. This package attempt to solve the issue by allowing to use a unified key "identifier" and you can customize which attributes Laravel should check during authentication.


## Installation

To install through composer, simply put the following in your `composer.json` file:

```json
{
    "require": {
        "laravie/authen": "~0.2"
    }
}
```

And then run `composer install` from the terminal.

### Quick Installation

Above installation can also be simplify by using the following command:

    composer require "laravie/authen=~0.1"

## Usages

### Service Provider

First you can attach the auth provider on `App\Providers\AuthServiceProvider`:

```php
<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravie\Authen\BootAuthenProvider;

class AuthServiceProvider extends ServiceProvider
{
    use BootAuthenProvider;

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->bootAuthenProvider();
    }
}
```

### User Model

Secondly, you need to update the related `App\User` (or the eloquent model mapped for auth).

```php
<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravie\Authen\AuthenUser;

class User extends Authenticatable
{
    use Notifiable, AuthenUser;

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return array
     */
    public function getAuthIdentifiersName()
    {
        return ['email', 'username', 'phone_number'];
    }
}
```

With this setup, you can now check either `email`, `username` or `phone_number` during authentication.

### Configuration

Lastly, you need to update the config `config/auth.php`:

```php
<?php

return [

    // ...

    'providers' => [
        'users' => [
            'driver' => 'authen',
            'model'  => App\User::class,
        ],
    ],

    // ...
];
```

### Examples

Here's an example how to login.

```php
<?php 

use Illuminate\Support\Facades\Auth;

$data = ['identifier' => 'crynobone@gmail.com', 'password' => 'foobar'];

if (Auth::attempt($data)) {
    // you can logged in, you can also pass your phone number of username to `identifier`.
}
```
