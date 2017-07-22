<?php

/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
class ApiClientTest extends PHPUnit_Framework_TestCase
{
    /** @var \Tigris\Telegram\ApiClient */
    public $a;

    public function setUp()
    {
        parent::setUp();

        $stream = \GuzzleHttp\Psr7\stream_for('{"ok": true, "result" : { "test": "passed"}}');
        $response = new \GuzzleHttp\Psr7\Response(200, ['Content-Type' => 'application/json'], $stream);

        $client = $this->getMockBuilder(\GuzzleHttp\Client::class)->setMethods(['post'])->getMock();
        $client->method('post')->willReturn($response);

        $client = new \Tigris\Telegram\ApiClient($client);
        $client->setApiToken('TEST');

        $this->a = $client;
    }

    public function testCall()
    {
        $this->assertEquals(['test' => 'passed'], $this->a->call('test'));
    }
}
