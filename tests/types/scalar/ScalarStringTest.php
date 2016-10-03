<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Types\Scalar\ScalarString;

class ScalarStringTest extends PHPUnit_Framework_TestCase
{
    public function testReadData()
    {
        $this->assertInternalType('string', ScalarString::readData(123));
        $this->assertSame(ScalarString::readData('test'), 'test');
    }
}
