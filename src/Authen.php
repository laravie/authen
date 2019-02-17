<?php

namespace Laravie\Authen;

use InvalidArgumentException;

class Authen
{
    /**
     * Identifier name.
     *
     * @var string
     */
    public static $identifier = 'identifier';

    /**
     * Get identifier name.
     *
     * @return string
     */
    public static function getIdentifierName(): string
    {
        return static::$identifier;
    }

    /**
     * Set identifier name.
     *
     * @param string $identifier
     *
     * @throws \InvalidArgumentException
     */
    public static function setIdentifierName(string $identifier): void
    {
        if (empty($identifier)) {
            throw new InvalidArgumentException("Identifier shouldn't be empty.");
        } elseif (\in_array($identifier, ['password'])) {
            throw new InvalidArgumentException("Identifier [{$identifier}] is not allowed!");
        }

        static::$identifier = $identifier;
    }
}
