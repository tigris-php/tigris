<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Telegram\Exceptions\TypeException;
use Tigris\Telegram\Types\PhotoSize;
use Tigris\Telegram\Types\Video;

class VideoTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = Video::parse([
            'file_id' => '123',
            'width' => 640,
            'height' => 480,
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
        $this->assertAttributeSame('123', 'file_id', $a);
        $this->assertAttributeSame(640, 'width', $a);
        $this->assertAttributeSame(480, 'height', $a);
        $this->assertAttributeSame(60, 'duration', $a);
        $this->assertAttributeInstanceOf(PhotoSize::class, 'thumb', $a);
        $this->assertAttributeSame('video/mp4', 'mime_type', $a);
        $this->assertAttributeSame(1024, 'file_size', $a);

        $b = Video::parse($a);
        $this->assertSame($a, $b);

        $z = Video::parse(null);
        $this->assertNull($z);

        try {
            Video::parse(123);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TypeException::class, $e);
        }

        try {
            Video::parse([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TypeException::class, $e);
        }
    }
}
