<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Types\Arrays\PhotoSizeArray;
use Tigris\Types\PhotoSize;

class PhotoSizeArrayTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = PhotoSizeArray::parse([
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
        ]);

        $this->assertInstanceOf(PhotoSizeArray::class, $a);
        $this->assertInstanceOf(PhotoSize::class, $a[0]);
        $this->assertInstanceOf(PhotoSize::class, $a[1]);

        $b = PhotoSizeArray::parse($a);
        $this->assertSame($a, $b);

        $z = PhotoSize::parse(null);
        $this->assertNull($z);
    }
}
