<?php
declare(strict_types=1);

namespace Samius;


class Email
{
    public const EMAIL_PATTERN = '/^[a-zA-Z0-9.!#$%&\'*+\\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+$/';

    /**
     * @param string $value
     * @return bool
     */
    public static function isValidEmail(string $value): bool
    {
        return (bool)preg_match(self::EMAIL_PATTERN, $value);
    }

}