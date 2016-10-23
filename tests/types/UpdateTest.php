<?php


class UpdateTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {

        $a = Tigris\Types\Update::parse([
            'type' => 123
        ]);

        $this->assertInstanceOf(\Tigris\Types\Update::class, $a);
        $this->assertAttributeSame('unknown', 'type', $a);

    }
}