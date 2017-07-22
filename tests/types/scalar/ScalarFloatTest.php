<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Telegram\Types\Scalar\ScalarFloat;

class ScalarFloatTest extends PHPUnit_Framework_TestCase
{
    public function testReadData()
    {
        $this->assertInternalType('float', ScalarFloat::readData('1.5'));
        $this->assertSame(ScalarFloat::readData(1.5), 1.5);
    }
}
