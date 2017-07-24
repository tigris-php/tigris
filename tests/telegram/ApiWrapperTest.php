<?php

/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
class ApiWrapperTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param $json
     * @return \Tigris\Telegram\ApiWrapper
     */
    protected function mockApi($json)
    {
        $stream = \GuzzleHttp\Psr7\stream_for('{"ok": true, "result" : ' . $json . '}');
        $response = new \GuzzleHttp\Psr7\Response(200, ['Content-Type' => 'application/json'], $stream);

        $client = $this->getMockBuilder(\GuzzleHttp\Client::class)->setMethods(['post'])->getMock();
        $client->method('post')->willReturn($response);

        $client = new \Tigris\Telegram\ApiClient($client);
        $client->setApiToken('TEST');

        return new \Tigris\Telegram\ApiWrapper($client);
    }

    // updates methods
    public function testGetMe()
    {
        $api = $this->mockApi('{ "id": 1 }');
        $this->assertNotNull($api->getMe());
    }
}
