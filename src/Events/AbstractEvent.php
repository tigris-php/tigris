<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Events;

use YarCode\Event\Event;

abstract class AbstractEvent extends Event
{
    /**
     * BotEvent constructor.
     */
    protected function __construct()
    {
    }
}