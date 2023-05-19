<?php
declare(strict_types=1);

namespace Samius;


class Email
{
    public const EMAIL_PATTERN = '/^[a-zA-Z0-9.!#$%&\'*+\\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+$/';

    public static function isValidEmail(string $value): bool
    {
        return (bool)preg_match(self::EMAIL_PATTERN, $value);
    }

    /**
     * Mask email with - tester@example.com -> te***r@ex****e.com
     * @param string $email - email to mask
     * @param int $first - number of letters to show from the beginning in each part of address
     * @param int $last - number of letters to show from the end in each part of address
     * @param int $fixedMaskLength - do not replace every masked letter with * but use fixed number of * between first and last letters
     * @return string
     */
    public static function maskEmail(string $email, int $first = 2, int $last = 1, int $fixedMaskLength=0): string
    {
       $mailParts = explode('@', $email);
       $domainParts = explode('.', $mailParts[1]);

       $mailParts[0] = self::maskPart($mailParts[0], $first, $last, $fixedMaskLength);
       $domainParts[0] = self::maskPart($domainParts[0], $first, $last, $fixedMaskLength);
       $mailParts[1] = implode('.', $domainParts);

       return implode('@', $mailParts);
    }

    private static function maskPart(string $str, int $first, int $last, int $fixedMaskLength): string
    {
       $len = strlen($str);
       $toShow = $first + $last;

       if ($fixedMaskLength > 0) {
            $hiddenLettersCount = $fixedMaskLength;
       } else {
            $hiddenLettersCount = $len - ($len <= $toShow ? 0 : $toShow);
        }


       return substr($str, 0, $len <= $toShow ? 0 : $first) .
           str_repeat('*', $hiddenLettersCount) .
           substr($str, $len - $last, $len <= $toShow ? 0 : $last);
    }

}
