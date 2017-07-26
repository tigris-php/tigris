<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram;

use GuzzleHttp\Client;
use Tigris\Bot;
use React\EventLoop\Factory as EventLoopFactory;

class BotFactory
{
    /** @var Bot */
    private $className;

    function __construct($className = Bot::class)
    {
        if (!is_subclass_of($className, Bot::class)) {
            throw new \InvalidArgumentException('Wrong class');
        }
        $this->className;
    }

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