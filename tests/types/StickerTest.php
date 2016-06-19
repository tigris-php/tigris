<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Exceptions\TelegramTypeException;
use Tigris\Types\Contact;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;
use Tigris\Types\Sticker;
use Tigris\Types\PhotoSize;

class StickerTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = Sticker::build([
            'file_id' => 'foobar',
            'width' => 640,
            'height' => 480,
            'thumb' => [
                'file_id' => 'foobar',
                'width' => 640,
                'height' => 480,
                'file_size' => 1024,
            ],
            'emoji' => 'foobar',
            'file_size' => 1024,
        ]);

        $this->assertInstanceOf(Sticker::class, $a);
        $this->assertAttributeInstanceOf(ScalarString::class, 'file_id', $a);
        $this->assertAttributeInstanceOf(ScalarInteger::class, 'width', $a);
        $this->assertAttributeInstanceOf(ScalarInteger::class, 'height', $a);
        $this->assertAttributeInstanceOf(PhotoSize::class, 'thumb', $a);
        $this->assertAttributeInstanceOf(ScalarString::class, 'emoji', $a);
        $this->assertAttributeInstanceOf(ScalarInteger::class, 'file_size', $a);

        $b = Sticker::build($a);
        $this->assertSame($a, $b);

        $z = Sticker::build(null);
        $this->assertNull($z);

        try {
            Sticker::build('scalar');
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }

        try {
            Sticker::build([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }
    }
}
