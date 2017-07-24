<?php


class WebhookInfoTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = Tigris\Telegram\Types\WebhookInfo::parse([
            'url' => 'test'
        ]);

        $this->assertInstanceOf(\Tigris\Telegram\Types\WebhookInfo::class, $a);
        $this->assertAttributeSame('test', 'url', $a);
    }
}