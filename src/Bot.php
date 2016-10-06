<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris;

use Evenement\EventEmitterTrait;
use GuzzleHttp\Client;
use React\Dns\Resolver\Factory as ResolverFactory;
use React\EventLoop\Factory as EventLoopFactory;
use React\EventLoop\LoopInterface;
use Tigris\Events\UpdateEvent;
use Tigris\Plugins\DefaultCommandParser;
use Tigris\Plugins\DefaultUpdateHandler;
use Tigris\Receivers\AbstractReceiver;
use Tigris\Telegram\Api;
use Tigris\Types\Message;
use Tigris\Types\MessageEntity;
use Tigris\Types\Update;

abstract class Bot
{
    use EventEmitterTrait;

    const DEFAULT_PLUGINS = [
        DefaultUpdateHandler::class,
        DefaultCommandParser::class,
    ];

    protected $apiToken;

    protected $loop;
    protected $resolver;

    /** @var AbstractReceiver */
    protected $receiver;
    /** @var Client */
    protected $client;
    /** @var Api */
    protected $api;
    /** @var UpdatesQueue */
    protected $updatesQueue;
    /** @var BotPlugin[]  */
    protected $plugins = [];

    final protected function __construct()
    {
        $this->loop = EventLoopFactory::create();
        $this->resolver = (new ResolverFactory())->createCached('8.8.8.8', $this->loop);
        $this->updatesQueue = new UpdatesQueue();
    }

    /**
     * @param string $apiToken
     * @return static
     */
    final public static function create($apiToken)
    {
        $bot = new static();
        $bot->api = Api::create($apiToken);

        // loading default plugins
        foreach (static::DEFAULT_PLUGINS as $pluginClass) {
            $bot->addPlugin($pluginClass);
        }

        $bot->bootstrap();
        return $bot;
    }

    final public function run()
    {
        $this->loop->addPeriodicTimer(0.1, function () {
            while (!$this->updatesQueue->isEmpty()) {
                $item = $this->updatesQueue->extract();
                $this->emit(UpdateEvent::EVENT_UPDATE_RECEIVED, [UpdateEvent::create($item)]);
            }
        });

        $this->loop->run();
    }

    /**
     * @return LoopInterface
     */
    public function getLoop()
    {
        return $this->loop;
    }

    /**
     * @return UpdatesQueue
     */
    public function getUpdatesQueue()
    {
        return $this->updatesQueue;
    }

    /**
     * @return Api
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * @param AbstractReceiver $receiver
     */
    public function setReceiver(AbstractReceiver $receiver)
    {
        $this->receiver = $receiver;
        $this->receiver->setBot($this);
    }

    /**
     * @param string $className
     * @throws \InvalidArgumentException
     */
    public function addPlugin($className)
    {
        if (!class_exists($className)) {
            throw new \InvalidArgumentException("Unknown plugin className {$className}");
        }

        if (isset($this->plugins[$className])) {
            return;
        }

        /** @var BotPlugin $plugin */
        $plugin = new $className;
        $plugin->setBot($this);
        $this->plugins[$className] = $plugin;
        $plugin->bootstrap();
    }

    /**
     * Override this method to extend the functionality.
     */
    protected function bootstrap()
    {
    }
}