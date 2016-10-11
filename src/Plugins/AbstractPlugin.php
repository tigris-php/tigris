<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Plugins;

use Tigris\Bot;

abstract class AbstractPlugin
{
    /** @var Bot */
    protected $bot;

    /**
     * @param Bot $bot
     */
    public function setBot(Bot $bot)
    {
        $this->bot = $bot;
    }

    /**
     * @return static
     */
    public static function getInstance()
    {
        return Bot::getInstance()->getPlugin(static::class);
    }

    /**
     * Implement this method and register plugin's event handlers
     */
    abstract public function bootstrap();
}