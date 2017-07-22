<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Telegram\Exceptions\TypeException;
use Tigris\Telegram\Types\Document;
use Tigris\Telegram\Types\PhotoSize;

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
            $this->assertInstanceOf(TypeException::class, $e);
        }

        try {
            Document::parse([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TypeException::class, $e);
        }
    }
}
