<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Exceptions\TelegramTypeException;
use Tigris\Types\File;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;

class FileTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = File::build([
            'file_id' => '123',
            'file_size' => 1024,
            'file_path' => 'path',
        ]);

        $this->assertInstanceOf(File::class, $a);
        $this->assertAttributeSame('123', 'file_id', $a);
        $this->assertAttributeSame(1024, 'file_size', $a);
        $this->assertAttributeSame('path', 'file_path', $a);

        $b = File::build($a);
        $this->assertSame($a, $b);

        $z = File::build(null);
        $this->assertNull($z);

        try {
            File::build('scalar');
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }

        try {
            File::build([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }
    }
}
