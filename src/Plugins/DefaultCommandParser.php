<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Plugins;

use Tigris\BotPlugin;
use Tigris\Events\CommandEvent;
use Tigris\Events\MessageEvent;
use Tigris\Types\MessageEntity;

class DefaultCommandParser extends BotPlugin
{
    /**
     * @inheritdoc
     */
    public function bootstrap()
    {
        $this->bot->addListener(MessageEvent::EVENT_TEXT_MESSAGE_RECEIVED, [$this, 'onTextMessageReceived']);
    }

    /**
     * @param MessageEvent $event
     */
    public function onTextMessageReceived(MessageEvent $event)
    {
        $message = $event->message;

        array_walk($message->entities, function(MessageEntity $entity) use ($message, $event) {
            $foundCommand = false;
            if ($entity->type === MessageEntity::TYPE_BOT_COMMAND) {
                $command = mb_substr($message->text, $entity->offset, $entity->length);
                $parts = explode('@', $command);
                if (count($parts)>1) {
                    if ($parts[1] == $this->bot->getUserInfo()->username) {
                        $command = $parts[0];
                    } else {
                        return;
                    }
                }
                $command = mb_substr($command, 1);
                $payload = mb_substr($message->text, $entity->offset + $entity->length);
                $payload = mb_substr($payload, 1);
                $this->bot->emit(CommandEvent::EVENT_COMMAND_RECEIVED, CommandEvent::create($message, $command, $payload));
                $foundCommand = true;
            }
            if ($foundCommand) {
                $event->handled = true;
            }
        });
    }
}