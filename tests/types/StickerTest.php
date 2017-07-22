<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Telegram\Exceptions\TypeException;
use Tigris\Telegram\Types\PhotoSize;
use Tigris\Telegram\Types\Sticker;

class StickerTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = Sticker::parse([
            'file_id' => '123',
            'width' => 640,
            'height' => 480,
            'thumb' => [
                'file_id' => 'foobar',
                'width' => 640,
                'height' => 480,
                'file_size' => 1024,
            ],
            'emoji' => 'emoji',
            'file_size' => 1024,
        ]);

        $this->assertInstanceOf(Sticker::class, $a);
        $this->assertAttributeSame('123', 'file_id', $a);
        $this->assertAttributeSame(640, 'width', $a);
        $this->assertAttributeSame(480, 'height', $a);
        $this->assertAttributeInstanceOf(PhotoSize::class, 'thumb', $a);
        $this->assertAttributeSame('emoji', 'emoji', $a);
        $this->assertAttributeSame(1024, 'file_size', $a);

        $b = Sticker::parse($a);
        $this->assertSame($a, $b);

        $z = Sticker::parse(null);
        $this->assertNull($z);

        try {
            Sticker::parse('scalar');
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TypeException::class, $e);
        }

        try {
            Sticker::parse([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TypeException::class, $e);
        }
    }
}
