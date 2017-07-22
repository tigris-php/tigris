<?php


class UpdateTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {

        $a = Tigris\Telegram\Types\Update::parse([
            'type' => 123
        ]);

        $this->assertInstanceOf(\Tigris\Telegram\Types\Update::class, $a);
        $this->assertAttributeSame('unknown', 'type', $a);

    }
}