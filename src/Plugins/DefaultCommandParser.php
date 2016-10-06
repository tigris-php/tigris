<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Plugins;

use Tigris\BotPlugin;
use Tigris\Events\MessageEvent;
use Tigris\Types\MessageEntity;

class DefaultCommandParser extends BotPlugin
{
    /**
     * @inheritdoc
     */
    public function bootstrap()
    {
        $this->bot->on(MessageEvent::EVENT_TEXT_MESSAGE_RECEIVED, [$this, 'onTextMessageReceived']);
    }

    /**
     * @param MessageEvent $event
     */
    public function onTextMessageReceived(MessageEvent $event)
    {
        $message = $event->message;

        array_walk($message->entities, function(MessageEntity $entity) use ($message) {
            if ($entity->type === MessageEntity::TYPE_BOT_COMMAND) {
                $command = substr($message->text, $entity->offset, $entity->length);
                var_dump($command);
            }
        });
    }
}