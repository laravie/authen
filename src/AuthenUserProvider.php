<?php

namespace Laravie\Authen;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Laravie\Authen\Contracts\Identifiers;
use Illuminate\Auth\EloquentUserProvider;

class AuthenUserProvider extends EloquentUserProvider
{
    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (! isset($credentials['identifier'])) {
            return parent::retrieveByCredentials($credentials);
        }

        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.

        return $this->resolveCredentialsByIdentifiers($this->createModel()->newQuery(), $credentials);
    }

    /**
     * Resolve credentials by multiple identifiers.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $credentials
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    protected function resolveCredentialsByIdentifiers(Builder $query, array $credentials)
    {
        $identifier = $credentials['identifier'];
        unset($credentials['identifier']);

        $names = $query->getModel()->getAuthIdentifiersName();

        $query->where(function ($query) use ($names, $identifier) {
            foreach ($names as $name) {
                $query->orWhere($name, '=', $identifier);
            }
        });

        foreach ($credentials as $key => $value) {
            if (! Str::contains($key, 'password')) {
                $query->where($key, $value);
            }
        }

        return $query->first();
    }
}
