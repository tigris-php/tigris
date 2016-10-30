<?php

/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
class ArrayHelperTest extends PHPUnit_Framework_TestCase
{
    /** @var \Tigris\Helpers\ArrayHelper */
    public $a;

    public function setUp()
    {
        parent::setUp();
        $this->a = new \Tigris\Helpers\ArrayHelper();
    }

    public function testGetValue()
    {
        try {
            $this->a->getValue([], null);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(InvalidArgumentException::class, $e);
        }
        
        $this->assertEquals(null, $this->a->getValue(null, 'test'));
        $this->assertEquals('default', $this->a->getValue([], 'test', 'default'));
    }
}
