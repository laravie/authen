<?php

namespace Laravie\Authen;

use Illuminate\Support\Str;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

class AuthenUserProvider extends EloquentUserProvider
{
    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials): ?UserContract
    {
        $name = Authen::getIdentifierName();

        if (! isset($credentials[$name]) || empty($credentials[$name])) {
            return parent::retrieveByCredentials($credentials);
        }

        $identifier = $credentials[$name];
        unset($credentials[$name]);

        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.

        $query = $this->createModel()
                    ->newQuery()
                    ->findByIdentifiers($identifier);

        foreach ($credentials as $key => $value) {
            if (! Str::contains($key, 'password')) {
                $query->where($key, $value);
            }
        }

        return $query->first();
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(UserContract $user, array $credentials): bool
    {
        $plain = $credentials['password'];
        $hashed = $user->getAuthPassword();

        if (\strlen($hashed) === 0) {
            return false;
        }

        return \password_verify($plain, $hashed) || $this->hasher->check($plain, $hashed);
    }
}
