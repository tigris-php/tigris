<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Types\PhotoSize;
use Tigris\Types\Arrays\PhotoSizeArray;
use Tigris\Types\Arrays\PhotoSizeMatrix;

class PhotoSizeMatrixTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = PhotoSizeMatrix::build([
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

        $this->assertInstanceOf(PhotoSizeMatrix::class, $a);
        $this->assertInstanceOf(PhotoSize::class, $a[0][0]);
        $this->assertInstanceOf(PhotoSize::class, $a[0][1]);
        $this->assertInstanceOf(PhotoSize::class, $a[1][0]);
        $this->assertInstanceOf(PhotoSize::class, $a[1][1]);

        $b = PhotoSizeArray::build($a);
        $this->assertSame($a, $b);

        $z = PhotoSize::build(null);
        $this->assertNull($z);
    }
}
