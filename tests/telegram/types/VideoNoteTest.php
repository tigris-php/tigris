<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Telegram\Exceptions\TypeException;
use Tigris\Telegram\Types\PhotoSize;
use Tigris\Telegram\Types\VideoNote;

class VideoNoteTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = VideoNote::parse([
            'file_id' => '123',
            'length' => 640,
            'duration' => 60,
            'thumb' => [
                'file_id' => 'foobar',
                'width' => 640,
                'height' => 480,
                'file_size' => 1024,
            ],
            'file_size' => 1024,
        ]);

        $this->assertInstanceOf(VideoNote::class, $a);
        $this->assertAttributeSame('123', 'file_id', $a);
        $this->assertAttributeSame(640, 'length', $a);
        $this->assertAttributeSame(60, 'duration', $a);
        $this->assertAttributeInstanceOf(PhotoSize::class, 'thumb', $a);
        $this->assertAttributeSame(1024, 'file_size', $a);

        $b = VideoNote::parse($a);
        $this->assertSame($a, $b);

        $z = VideoNote::parse(null);
        $this->assertNull($z);

        try {
            VideoNote::parse(123);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TypeException::class, $e);
        }

        try {
            VideoNote::parse([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TypeException::class, $e);
        }
    }
}
