<?php

namespace Laravie\Authen\Contracts;

interface Identifiers
{
    /**
     * Get the name of the unique identifier for the user.
     *
     * @return array
     */
    public function getAuthIdentifiersName();
}
