<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris;

abstract class BotPlugin
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
     * Implement this method and register plugin's event handlers
     */
    abstract public function bootstrap();
}