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
    public function testParse()
    {
        $a = Document::parse([
            'file_id' => '123',
            'thumb' => [
                'file_id' => 'foobar',
                'width' => 640,
                'height' => 480,
                'file_size' => 1024,
            ],
            'file_name' => 'foo',
            'mime_type' => 'bar',
            'file_size' => 1024,
        ]);

        $this->assertInstanceOf(Document::class, $a);
        $this->assertAttributeSame('123', 'file_id', $a);
        $this->assertAttributeInstanceOf(PhotoSize::class, 'thumb', $a);
        $this->assertAttributeSame('foo', 'file_name', $a);
        $this->assertAttributeSame('bar', 'mime_type', $a);
        $this->assertAttributeSame(1024, 'file_size', $a);

        $b = Document::parse($a);
        $this->assertSame($a, $b);

        $z = Document::parse(null);
        $this->assertNull($z);

        try {
            Document::parse('scalar');
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }

        try {
            Document::parse([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }
    }
}
