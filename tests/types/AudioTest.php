<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Types\Audio;
use Tigris\Types\Scalar\ScalarString;
use Tigris\Types\Scalar\ScalarInteger;

class AudioTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = Audio::build([
            'file_id' => 'foobar',
            'duration' => 123,
        ]);
        
        $this->assertInstanceOf(Audio::class, $a);
        $this->assertAttributeInstanceOf(ScalarString::class, 'file_id', $a);
        $this->assertAttributeInstanceOf(ScalarInteger::class, 'duration', $a);

        $b = Audio::build($a);
        $this->assertSame($a, $b);

        $z = Audio::build(null);
        $this->assertNull($z);
    }

    /**
     * @expectedException \Tigris\Exceptions\TelegramTypeException
     */
    public function testBuildScalar()
    {
        Audio::build(123);
    }

    /**
     * @expectedException \Tigris\Exceptions\TelegramTypeException
     */
    public function testBuildEmptyArray()
    {
        Audio::build([]);
    }
}
