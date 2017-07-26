<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris;

use React\EventLoop\LoopInterface;
use Tigris\Events\UpdateEvent;
use Tigris\Plugins\AbstractPlugin;
use Tigris\Plugins\PollingReceiver;
use Tigris\Plugins\UpdateHandler;
use Tigris\Sessions\AbstractSession;
use Tigris\Sessions\AbstractSessionFactory;
use Tigris\Sessions\InMemorySessionFactory;
use Tigris\Telegram\ApiWrapper;
use Tigris\Telegram\Types\User;
use YarCode\Event\EventEmitterTrait;

class Bot
{
    use EventEmitterTrait;

    protected static $instance;

    /** @var LoopInterface */
    protected $loop;
    /** @var ApiWrapper */
    protected $api;
    /** @var UpdateQueue */
    protected $updateQueue;
    /** @var string */
    protected $storageDir;
    /** @var User */
    protected $userInfo;
    /** @var AbstractSessionFactory */
    protected $chatSessionFactory;
    /** @var AbstractPlugin[] */
    protected $plugins = [];

    final public function __construct(LoopInterface $loop, ApiWrapper $apiWrapper)
    {
        // setting up components
        $this->loop = $loop;
        $this->updateQueue = new UpdateQueue();
        $this->api = $apiWrapper;
        // loading plugins
        $this->setPlugins($this->plugins());
        // loading bot information (will fail on wrong api key)
        $this->refreshUserInfo();
        // bootstrapping bot instance
        $this->bootstrap();
        self::$instance = $this;
    }

    /**
     * @param array $plugins Array of plugin classes or instances to be registered.
     */
    final public function setPlugins(array $plugins)
    {
        foreach ($plugins as $plugin) {
            $this->addPlugin($plugin);
        }
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
     * @return array Array of plugin classes or instances to be registered at bot creation.
     */
    public function plugins()
    {
        return [
            UpdateHandler::class,
            PollingReceiver::class,
        ];
    }

    /**
     * Refreshes user model
     */
    public function refreshUserInfo()
    {
        $this->userInfo = $this->getApi()->getMe();
        if ($this->userInfo == null) {
            throw new \LogicException('Failed to load bot information');
        }
    }

    /**
     * @return ApiWrapper
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * Override this method to extend the functionality.
     */
    protected function bootstrap()
    {
    }

    /**
     * @return static
     * @throw BadMethodCallException
     */
    final public static function getInstance()
    {
        if (!isset(self::$instance)) {
            throw new \BadMethodCallException('Bot instance was not created');
        }
        return self::$instance;
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
     * @param AbstractSessionFactory $factory
     */
    public function setChatSessionFactory(AbstractSessionFactory $factory)
    {
        $this->chatSessionFactory = $factory;
    }

    /**
     * @return User
     */
    public function getUserInfo()
    {
        return $this->userInfo;
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
     * Returns session object for a specified chat
     *
     * @param integer $chatId
     * @return AbstractSession
     */
    public function getChatSession($chatId)
    {
        return $this->chatSessionFactory->getSession($chatId);
    }
}