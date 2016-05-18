<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Types\Scalar\ScalarBoolean;

class ScalarBooleanTest extends PHPUnit_Framework_TestCase
{
    public function testReadData()
    {
        $this->assertInternalType('boolean', ScalarBoolean::readData(123));
        $this->assertSame(ScalarBoolean::readData(0), false);
        $this->assertSame(ScalarBoolean::readData(1), true);
    }

    /**
     * @depends testReadData
     */
    public function testBuild()
    {
        $a = ScalarBoolean::build(true);
        $this->assertInstanceOf(ScalarBoolean::class, $a);
        $this->assertAttributeSame(true, 'value', $a);

        $b = ScalarBoolean::build(false);
        $this->assertInstanceOf(ScalarBoolean::class, $b);
        $this->assertAttributeSame(false, 'value', $b);

        $z = ScalarBoolean::build(null);
        $this->assertNull($z);
    }
}
