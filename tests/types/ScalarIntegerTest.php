<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Types\Scalar\ScalarInteger;

class ScalarIntegerTest extends PHPUnit_Framework_TestCase
{
    public function testReadData()
    {
        $this->assertInternalType('integer', ScalarInteger::readData(123));
        $this->assertSame(ScalarInteger::readData(123), 123);
    }

    /**
     * @depends testReadData
     */
    public function testBuild()
    {
        $a = ScalarInteger::build(-1);
        $this->assertInstanceOf(ScalarInteger::class, $a);
        $this->assertAttributeSame(-1, 'value', $a);

        $b = ScalarInteger::build(1);
        $this->assertInstanceOf(ScalarInteger::class, $b);
        $this->assertAttributeSame(1, 'value', $b);

        $c = ScalarInteger::build(0);
        $this->assertInstanceOf(ScalarInteger::class, $c);
        $this->assertAttributeSame(0, 'value', $c);

        $z = ScalarInteger::build(null);
        $this->assertNull($z);
    }
}
