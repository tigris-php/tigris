<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Exceptions\TelegramTypeException;
use Tigris\Types\PhotoSize;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;
use Tigris\Types\Video;

class VideoTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = Video::build([
            'file_id' => 'foobar',
            'width' => 400,
            'height' => 300,
            'duration' => 60,
            'thumb' => [
                'file_id' => 'foobar',
                'width' => 640,
                'height' => 480,
                'file_size' => 1024,
            ],
            'mime_type' => 'video/mp4',
            'file_size' => 1024,
        ]);

        $this->assertInstanceOf(Video::class, $a);
        $this->assertAttributeInstanceOf(ScalarString::class, 'file_id', $a);
        $this->assertAttributeInstanceOf(ScalarInteger::class, 'width', $a);
        $this->assertAttributeInstanceOf(ScalarInteger::class, 'height', $a);
        $this->assertAttributeInstanceOf(ScalarInteger::class, 'duration', $a);
        $this->assertAttributeInstanceOf(PhotoSize::class, 'thumb', $a);
        $this->assertAttributeInstanceOf(ScalarString::class, 'mime_type', $a);
        $this->assertAttributeInstanceOf(ScalarInteger::class, 'file_size', $a);

        $b = Video::build($a);
        $this->assertSame($a, $b);

        $z = Video::build(null);
        $this->assertNull($z);

        try {
            Video::build(123);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }

        try {
            Video::build([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }
    }
}
