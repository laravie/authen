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
        if (! (isset($credentials['identifier']) && $this->model instanceof Identifiers)) {
            return parent::retrieveByCredentials($credentials);
        }

        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.
        $query = $this->createModel()->newQuery();

        foreach ($credentials as $key => $value) {
            if (! Str::contains($key, 'password')) {
                $query->where($key, $value);
            }
        }

        return $this->resolveCredentialsByIdentifiers($query, $credentials);
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

        $names = $this->model->getAuthIdentifiersName();

        $query->where(function ($query) use ($names, $identifier) {
            foreach ($names as $name) {
                $query->orWhere($name, '=', $identifier);
            }
        });

        return $query->first();
    }
}
