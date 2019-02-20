<?php

use Samius\BitMap;

class BitMapTest extends \Codeception\Test\Unit
{
    public function testBitmap()
    {
        for ($length = 1; $length < 32; $length++) {
            for ($position = 1; $position < $length; $position++) {
                $res = BitMap::setToBitmap($length, 0, true, $position);
                $this->assertEquals(true, BitMap::getFromBitmap($length, $res, $position));
            }
        }

        try {
            BitMap::setToBitmap(10, 0, true, 10);
            $this->fail('should throw exception');
        } catch (\OutOfBoundsException $e) {
            //OK
        }
        try {
            BitMap::getFromBitmap(10, 0, 10);
            $this->fail('should throw exception');
        } catch (\OutOfBoundsException$e) {
            //OK
        }
    }
    //there was an error that set zero value to bitmap, after change least bit to false
    public function testBitmapFlush()
    {
        $val = 4294967295; //2^32 - 1
        $val = BitMap::setToBitmap(32, $val, false, 0);
        $this->assertEquals(4294967294, $val);
    }
}
