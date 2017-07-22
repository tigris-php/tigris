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
use Tigris\Plugins\AbstractPlugin;
use Tigris\Plugins\Command\CommandHandler;
use Tigris\Plugins\Menu\MenuHandler;
use Tigris\Plugins\PollingReceiver;
use Tigris\Plugins\UpdateHandler;
use Tigris\Sessions\AbstractSession;
use Tigris\Sessions\AbstractSessionFactory;
use Tigris\Sessions\InMemorySessionFactory;
use Tigris\Telegram\ApiWrapper;
use Tigris\Types\User;
use YarCode\Event\EventEmitterTrait;

abstract class Bot
{
    use EventEmitterTrait;

    protected static $instance;

    protected $apiToken;

    protected $loop;
    protected $resolver;

    protected $userInfo;

    protected $storageDir;

    /** @var Client */
    protected $client;
    /** @var ApiWrapper */
    protected $api;
    /** @var UpdateQueue */
    protected $updateQueue;
    /** @var AbstractSessionFactory */
    protected $chatSessionFactory;

    /** @var AbstractPlugin[]  */
    protected $plugins = [];

    final protected function __construct()
    {
        $this->loop = EventLoopFactory::create();
        $this->resolver = (new ResolverFactory())->createCached('8.8.8.8', $this->loop);
        $this->updateQueue = new UpdateQueue();
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

        $bot->api = ApiWrapper::create($apiToken);

        // loading plugins
        $bot->setPlugins($bot->plugins());

        // loading bot information
        $bot->refreshUserInfo();

        $bot->bootstrap();
        return $bot;
    }

    /**
     * @return array Array of plugin classes or instances to be registered at bot creation.
     */
    public function plugins()
    {
        return [
            UpdateHandler::class,
            CommandHandler::class,
            MenuHandler::class,
            PollingReceiver::class,
        ];
    }

    /**
     * @param array $plugins
     */
    final public function setPlugins(array $plugins)
    {
        foreach ($plugins as $plugin) {
            $this->addPlugin($plugin);
        }
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
        if (empty($this->chatSessionFactory)) {
            $this->setChatSessionFactory(new InMemorySessionFactory());
        }

        if (empty($this->storageDir)) {
            $this->storageDir = sys_get_temp_dir() . DIRECTORY_SEPARATOR
            . 'tigris' . DIRECTORY_SEPARATOR . $this->getUserInfo()->username;
            @mkdir($this->storageDir, 0777, true);
            if (!is_dir($this->storageDir)) {
                die('Unable to create storage dir: ' . $this->storageDir);
            }
        }

        $this->loop->addPeriodicTimer(0.1, function () {
            while (!$this->updateQueue->isEmpty()) {
                $item = $this->updateQueue->extract();
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
     * @return UpdateQueue
     */
    public function getUpdateQueue()
    {
        return $this->updateQueue;
    }

    /**
     * @return ApiWrapper
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * @return string
     */
    public function getStorageDir()
    {
        return $this->storageDir;
    }

    /**
     * @param mixed $storageDir
     */
    public function setStorageDir($storageDir)
    {
        if (!is_dir($storageDir)) {
            throw new \BadMethodCallException('Invalid directory: ' . $storageDir);
        }
        $this->storageDir = $storageDir;
    }

    /**
     * @param string|AbstractPlugin $plugin
     * @throws \InvalidArgumentException
     */
    public function addPlugin($plugin)
    {
        if (is_string($plugin)) {
            if (!class_exists($plugin)) {
                throw new \InvalidArgumentException('Unknown plugin class' . $plugin);
            }
            $instance = new $plugin;
        } elseif (is_object($plugin)) {
            $instance = $plugin;
        } else {
            throw new \InvalidArgumentException('Invalid plugin');
        }

        $class = get_class($instance);

        if (!$instance instanceof AbstractPlugin) {
            throw new \InvalidArgumentException($class . ' must extend the ' . AbstractPlugin::class);
        }

        if (isset($this->plugins[$class])) {
            return;
        }

        /** @var AbstractPlugin $instance */
        $instance->setBot($this);
        $this->plugins[$class] = $instance;
        $instance->bootstrap();
    }

    /**
     * @param $className
     * @return AbstractPlugin
     */
    public function getPlugin($className)
    {
        if (!isset($this->plugins[$className])) {
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