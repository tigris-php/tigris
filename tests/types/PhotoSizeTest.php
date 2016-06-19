<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Exceptions\TelegramTypeException;
use Tigris\Types\PhotoSize;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;

class PhotoSizeTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = PhotoSize::build([
            'file_id' => 'foobar',
            'width' => 640,
            'height' => 480,
            'file_size' => 1024,
        ]);

        $this->assertInstanceOf(PhotoSize::class, $a);
        $this->assertAttributeInstanceOf(ScalarString::class, 'file_id', $a);
        $this->assertAttributeInstanceOf(ScalarInteger::class, 'width', $a);
        $this->assertAttributeInstanceOf(ScalarInteger::class, 'height', $a);
        $this->assertAttributeInstanceOf(ScalarInteger::class, 'file_size', $a);

        $b = PhotoSize::build($a);
        $this->assertSame($a, $b);

        $z = PhotoSize::build(null);
        $this->assertNull($z);

        try {
            PhotoSize::build(123);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }

        try {
            PhotoSize::build([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }
    }
}
