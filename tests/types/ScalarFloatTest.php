<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Types\Scalar\ScalarFloat;

class ScalarFloatTest extends PHPUnit_Framework_TestCase
{
    public function testReadData()
    {
        $this->assertInternalType('float', ScalarFloat::readData('1.5'));
        $this->assertSame(ScalarFloat::readData(1.5), 1.5);
    }

    /**
     * @depends testReadData
     */
    public function testBuild()
    {
        $a = ScalarFloat::build(-1.5);
        $this->assertInstanceOf(ScalarFloat::class, $a);
        $this->assertAttributeSame(-1.5, 'value', $a);

        $b = ScalarFloat::build(1.5);
        $this->assertInstanceOf(ScalarFloat::class, $b);
        $this->assertAttributeSame(1.5, 'value', $b);

        $c = ScalarFloat::build(0);
        $this->assertInstanceOf(ScalarFloat::class, $c);
        $this->assertAttributeSame(0.0, 'value', $c);

        $z = ScalarFloat::build(null);
        $this->assertNull($z);
    }
}
