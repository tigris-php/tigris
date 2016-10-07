<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Events;

use Tigris\BotEvent;
use Tigris\Types\Message;

class CommandEvent extends BotEvent
{
    const EVENT_COMMAND_RECEIVED = 'onCommandReceived';

    /** @var string */
    public $command;
    /** @var string */
    public $payload;
    /** @var Message */
    public $message;

    /**
     * @param Message $message
     * @param string $command
     * @param string $payload
     * @return static
     */
    public static function create(Message $message, $command, $payload = '')
    {
        $event = new static();
        $event->command = $command;
        $event->payload = $payload;
        $event->message = $message;
        return $event;
    }
}