<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris;

use GuzzleHttp\Client;
use React\Dns\Resolver\Factory as ResolverFactory;
use React\EventLoop\Factory as EventLoopFactory;
use React\EventLoop\LoopInterface;
use Tigris\Events\UpdateEvent;
use Tigris\Plugins\Menu\MenuHandler;
use Tigris\Plugins\CommandHandler;
use Tigris\Plugins\UpdateHandler;
use Tigris\Receivers\AbstractReceiver;
use Tigris\Receivers\PollingReceiver;
use Tigris\Session\AbstractSession;
use Tigris\Session\AbstractSessionFactory;
use Tigris\Session\InMemorySessionFactory;
use Tigris\Telegram\Api;
use Tigris\Types\User;
use YarCode\Event\EventEmitterTrait;

abstract class Bot
{
    use EventEmitterTrait;

    const DEFAULT_PLUGINS = [
        UpdateHandler::class,
        CommandHandler::class,
        MenuHandler::class,
    ];

    protected static $instance;

    protected $apiToken;

    protected $loop;
    protected $resolver;

    protected $userInfo;

    /** @var AbstractReceiver */
    protected $receiver;
    /** @var Client */
    protected $client;
    /** @var Api */
    protected $api;
    /** @var UpdatesQueue */
    protected $updatesQueue;
    /** @var AbstractSessionFactory */
    protected $chatSessionFactory;

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
     * @throws \BadMethodCallException
     */
    final public static function create($apiToken)
    {
        if (isset(static::$instance)) {
            throw new \BadMethodCallException('Bot instance is already created');
        }
        static::$instance = $bot = new static();

        $bot->api = Api::create($apiToken);

        // loading default plugins
        foreach (static::DEFAULT_PLUGINS as $pluginClass) {
            $bot->addPlugin($pluginClass);
        }
        // loading bot information
        $bot->refreshUserInfo();

        $bot->bootstrap();
        return $bot;
    }

    /**
     * @return static
     * @throw BadMethodCallException
     */
    final public static function getInstance()
    {
        if (!isset(static::$instance)) {
            throw new \BadMethodCallException('Bot instance was not created');
        }
        return static::$instance;
    }

    final public function run()
    {
        if (empty($this->receiver)) {
            $this->setReceiver(new PollingReceiver());
        }

        if (empty($this->chatSessionFactory)) {
            $this->setChatSessionFactory(new InMemorySessionFactory());
        }

        $this->loop->addPeriodicTimer(0.1, function () {
            while (!$this->updatesQueue->isEmpty()) {
                $item = $this->updatesQueue->extract();
                $this->emit(UpdateEvent::EVENT_UPDATE_RECEIVED, UpdateEvent::create($item));
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
     * @param $className
     * @return BotPlugin
     */
    public function getPlugin($className)
    {
        if (isset($this->plugins[$className])) {
            throw new \InvalidArgumentException('Plugin is missing: ' . $className);
        }
        return $this->plugins[$className];
    }

    /**
     * Refreshes user model
     */
    public function refreshUserInfo()
    {
        $this->userInfo = $this->api->getMe();
    }

    /**
     * @return User
     */
    public function getUserInfo()
    {
       return $this->userInfo;
    }

    /**
     * @param AbstractSessionFactory $factory
     */
    public function setChatSessionFactory(AbstractSessionFactory $factory)
    {
        $this->chatSessionFactory = $factory;
    }

    /**
     * @param integer $chatId
     * @return AbstractSession
     */
    public function getChatSession($chatId)
    {
        return $this->chatSessionFactory->getSession($chatId);
    }

    /**
     * Override this method to extend the functionality.
     */
    protected function bootstrap()
    {
    }
}