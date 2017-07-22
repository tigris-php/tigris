<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Telegram\Types\Scalar\ScalarInteger;

class ScalarIntegerTest extends PHPUnit_Framework_TestCase
{
    public function testReadData()
    {
        $this->assertInternalType('integer', ScalarInteger::readData(123));
        $this->assertSame(ScalarInteger::readData(123), 123);
    }
}
