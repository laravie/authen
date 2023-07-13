<?php

namespace Laravie\Authen;

use Illuminate\Database\Eloquent\Builder;

trait AuthenUser
{
    /**
     * Find by identifiers scope.
     *
     * @param  string|int  $username
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
     * @return array<int, string>
     */
    abstract public function getAuthIdentifiersName(): array;
}
