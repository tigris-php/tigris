<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Telegram\Types\Arrays\PhotoSizeArray;
use Tigris\Telegram\Types\Arrays\PhotoSizeMatrix;
use Tigris\Telegram\Types\PhotoSize;

class PhotoSizeMatrixTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = PhotoSizeMatrix::parse([
            [
                [
                    'file_id' => 'foobar',
                    'width' => 640,
                    'height' => 480,
                    'file_size' => 1024,
                ],
                [
                    'file_id' => 'foobar',
                    'width' => 640,
                    'height' => 480,
                    'file_size' => 1024,
                ],
            ],
            [
                [
                    'file_id' => 'foobar',
                    'width' => 640,
                    'height' => 480,
                    'file_size' => 1024,
                ],
                [
                    'file_id' => 'foobar',
                    'width' => 640,
                    'height' => 480,
                    'file_size' => 1024,
                ],
            ],
        ]);

        $this->assertInternalType('array', $a);
        $this->assertInstanceOf(PhotoSize::class, $a[0][0]);
        $this->assertInstanceOf(PhotoSize::class, $a[0][1]);
        $this->assertInstanceOf(PhotoSize::class, $a[1][0]);
        $this->assertInstanceOf(PhotoSize::class, $a[1][1]);

        $z = PhotoSize::parse(null);
        $this->assertNull($z);
    }
}
