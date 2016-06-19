<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Exceptions\TelegramTypeException;
use Tigris\Types\Document;
use Tigris\Types\PhotoSize;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;

class DocumentTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = Document::build([
            'file_id' => 'foobar',
            'thumb' => [
                'file_id' => 'foobar',
                'width' => 640,
                'height' => 480,
                'file_size' => 1024,
            ],
            'file_name' => 'foobar',
            'mime_type' => 'foobar',
            'file_size' => 1024,
        ]);

        $this->assertInstanceOf(Document::class, $a);
        $this->assertAttributeInstanceOf(ScalarString::class, 'file_id', $a);
        $this->assertAttributeInstanceOf(PhotoSize::class, 'thumb', $a);
        $this->assertAttributeInstanceOf(ScalarString::class, 'file_name', $a);
        $this->assertAttributeInstanceOf(ScalarString::class, 'mime_type', $a);
        $this->assertAttributeInstanceOf(ScalarInteger::class, 'file_size', $a);

        $b = Document::build($a);
        $this->assertSame($a, $b);

        $z = Document::build(null);
        $this->assertNull($z);

        try {
            Document::build('scalar');
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }

        try {
            Document::build([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }
    }
}
