<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Types\ScalarString;

class ScalarStringTest extends PHPUnit_Framework_TestCase
{
    public function testReadData()
    {
        $this->assertInternalType('string', ScalarString::readData(123));
        $this->assertSame(ScalarString::readData('123'), '123');
    }

    /**
     * @depends testReadData
     */
    public function testBuild()
    {
        $a = ScalarString::build(-1);
        $this->assertInstanceOf(ScalarString::class, $a);
        $this->assertAttributeSame('-1', 'value', $a);

        $b = ScalarString::build(1);
        $this->assertInstanceOf(ScalarString::class, $b);
        $this->assertAttributeSame('1', 'value', $b);

        $c = ScalarString::build('sample');
        $this->assertInstanceOf(ScalarString::class, $c);
        $this->assertAttributeSame('sample', 'value', $c);

        $d = ScalarString::build('');
        $this->assertInstanceOf(ScalarString::class, $d);
        $this->assertAttributeSame('', 'value', $d);

        $z = ScalarString::build(null);
        $this->assertNull($z);
    }
}
