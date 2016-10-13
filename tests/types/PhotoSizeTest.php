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
        $a = PhotoSize::parse([
            'file_id' => '123',
            'width' => 640,
            'height' => 480,
            'file_size' => 1024,
        ]);

        $this->assertInstanceOf(PhotoSize::class, $a);
        $this->assertAttributeSame('123', 'file_id', $a);
        $this->assertAttributeSame(640, 'width', $a);
        $this->assertAttributeSame(480, 'height', $a);
        $this->assertAttributeSame(1024, 'file_size', $a);

        $b = PhotoSize::parse($a);
        $this->assertSame($a, $b);

        $z = PhotoSize::parse(null);
        $this->assertNull($z);

        try {
            PhotoSize::parse(123);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }

        try {
            PhotoSize::parse([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }
    }
}
