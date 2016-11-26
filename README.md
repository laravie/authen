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
        "laravie/authen": "~0.1"
    }
}
```

And then run `composer install` from the terminal.

### Quick Installation

Above installation can also be simplify by using the following command:

    composer require "laravie/authen=~0.1"

## Usages

First you can attach the auth provider on `App\Providers\AuthServiceProvider`:

```php
<?php

namespace App\Providers;

use Laravie\Authen\BootAuthenProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
