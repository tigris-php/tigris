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
        $this->assertEquals(null, $this->a->getValue(null, 'test'));
        $this->assertEquals('default', $this->a->getValue([], 'test', 'default'));
    }

    public function testGetValueEmptyArgs()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->a->getValue([], null);
    }
}
