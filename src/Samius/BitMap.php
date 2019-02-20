<?php

namespace Samius;
/**
 * Class for bitmap operations
 */
class BitMap
{
    /**
     * Returns value of bitmap on given position
     *
     * @param int $length number of bits in bitmap
     * @param int $bitmapValue integer value of whole bitmap
     * @param int $position position number from right (0 is first, we are going from the least bit)
     * @return bool
     */
    public static function getFromBitmap(int $length, int $bitmapValue, int $position): bool
    {
        if ($position < 0 || $position > ($length-1)) {
            throw new \OutOfBoundsException($position);
        }
        if ($position === null) {
            return $bitmapValue;
        }
        $position = $length - 1 - $position;

        $byte = sprintf("%0{$length}s", decbin($bitmapValue));

        return (bool)$byte[$position];
    }

    /**
     * Sets value of bitmap on given position
     * @param int $length number of bits in bitmap
     * @param int $bitmapValue integer value of whole bitmap
     * @param bool $value value to be set
     * @param int $position which position to set - from right (0 is first, we are going from least bit)
     * @return number
     */
    public static function setToBitmap(int $length, int $bitmapValue, bool $value, int $position)
    {
        if ($position < 0 || $position> ($length-1)) {
            throw new \OutOfBoundsException($position);
        }
        $position = $length - 1 - $position;

        $byte = sprintf("%0{$length}s", decbin($bitmapValue));
        $byte[$position] = $value ? 1 : 0;

        return bindec($byte);
    }

}
