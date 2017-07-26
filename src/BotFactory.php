<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris;

use GuzzleHttp\Client;
use React\EventLoop\Factory as EventLoopFactory;
use Tigris\Telegram\ApiClient;
use Tigris\Telegram\ApiWrapper;

class BotFactory
{
    /** @var Bot */
    private $className;

    function __construct($className = Bot::class)
    {
        if (!is_subclass_of($className, Bot::class)) {
            throw new \InvalidArgumentException('Wrong class');
        }
        $this->className = $className;
    }

    /**
     * @param $apiToken
     * @return Bot
     */
    public function create($apiToken)
    {
        $httpClient = new Client();
        $apiClient = new ApiClient($httpClient);
        $apiClient->setApiToken($apiToken);
        $apiWrapper = new ApiWrapper($apiClient);
        $className = $this->className;
        $loop = EventLoopFactory::create();
        return new $className($loop, $apiWrapper);
    }
}