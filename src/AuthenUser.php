<?php

namespace Laravie\Authen;

use Illuminate\Database\Eloquent\Builder;

trait AuthenUser
{
    /**
     * Find by identifiers scope.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string|int  $username
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFindByIdentifiers(Builder $query, $username): Builder
    {
        $identifiers = $this->getAuthIdentifiersName();

        $query->where(static function ($query) use ($identifiers, $username) {
            foreach ($identifiers as $key) {
                $query->orWhere($key, '=', $username);
            }
        });

        return $query;
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return array
     */
    abstract public function getAuthIdentifiersName(): array;
}
