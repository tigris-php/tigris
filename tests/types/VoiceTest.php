<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Types\Voice;
use Tigris\Types\Scalar\ScalarString;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Exceptions\TelegramTypeException;

class VoiceTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = Voice::parse([
            'file_id' => '123',
            'duration' => 456,
        ]);
        
        $this->assertInstanceOf(Voice::class, $a);
        $this->assertAttributeSame('123', 'file_id', $a);
        $this->assertAttributeSame(456, 'duration', $a);

        $b = Voice::parse($a);
        $this->assertSame($a, $b);

        $z = Voice::parse(null);
        $this->assertNull($z);

        try {
            Voice::parse(123);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }

        try {
            Voice::parse([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }
    }
}
