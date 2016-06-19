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
            'file_id' => 'foobar',
            'file_size' => 1024,
            'file_path' => 'foobar',
        ]);

        $this->assertInstanceOf(File::class, $a);
        $this->assertAttributeInstanceOf(ScalarString::class, 'file_id', $a);
        $this->assertAttributeInstanceOf(ScalarInteger::class, 'file_size', $a);
        $this->assertAttributeInstanceOf(ScalarString::class, 'file_path', $a);

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
