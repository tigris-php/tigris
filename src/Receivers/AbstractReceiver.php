<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Receivers;

use Tigris\Bot;

abstract class AbstractReceiver
{
    /** @var Bot */
    protected $bot;

    public function setBot(Bot $bot)
    {
        $this->bot = $bot;
        $this->onSetBot();
    }

    protected abstract function onSetBot();
}