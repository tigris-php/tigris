<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Plugins;

use Tigris\BotPlugin;
use Tigris\Events\MessageEvent;
use Tigris\Events\UpdateEvent;
use Tigris\Types\Message;

class DefaultUpdateHandler extends BotPlugin
{
    /**
     * @inheritdoc
     */
    public function bootstrap()
    {
        $this->bot->on(UpdateEvent::EVENT_UPDATE_RECEIVED, [$this, 'onUpdateReceived']);
        $this->bot->on(MessageEvent::EVENT_MESSAGE_RECEIVED, [$this, 'onMessageReceived']);
    }

    /**
     * @param UpdateEvent $event
     */
    public function onUpdateReceived(UpdateEvent $event)
    {
        $update = $event->update;
        switch ($update->type) {
            case $update::TYPE_MESSAGE:
                $this->bot->emit(MessageEvent::EVENT_MESSAGE_RECEIVED, [MessageEvent::create($update->message)]);
                break;
            // TODO: add support for other update types
            default:
        }
    }

    /**
     * @param MessageEvent $event
     */
    public function onMessageReceived(MessageEvent $event)
    {
        $message = $event->message;
        switch ($message->type) {
            case Message::TYPE_AUDIO:
                $this->bot->emit(MessageEvent::EVENT_AUDIO_MESSAGE_RECEIVED, [$event]);
                break;
            case Message::TYPE_CONTACT:
                $this->bot->emit(MessageEvent::EVENT_CONTACT_MESSAGE_RECEIVED, [$event]);
                break;
            case Message::TYPE_DOCUMENT:
                $this->bot->emit(MessageEvent::EVENT_DOCUMENT_MESSAGE_RECEIVED, [$event]);
                break;
            case Message::TYPE_LOCATION:
                $this->bot->emit(MessageEvent::EVENT_LOCATION_MESSAGE_RECEIVED, [$event]);
                break;
            case Message::TYPE_PHOTO:
                $this->bot->emit(MessageEvent::EVENT_PHOTO_MESSAGE_RECEIVED, [$event]);
                break;
            case Message::TYPE_STICKER:
                $this->bot->emit(MessageEvent::EVENT_STICKER_MESSAGE_RECEIVED, [$event]);
                break;
            case Message::TYPE_TEXT:
                $this->bot->emit(MessageEvent::EVENT_TEXT_MESSAGE_RECEIVED, [$event]);
                break;
            case Message::TYPE_VENUE:
                $this->bot->emit(MessageEvent::EVENT_VENUE_MESSAGE_RECEIVED, [$event]);
                break;
            case Message::TYPE_VIDEO:
                $this->bot->emit(MessageEvent::EVENT_VIDEO_MESSAGE_RECEIVED, [$event]);
                break;
            case Message::TYPE_VOICE:
                $this->bot->emit(MessageEvent::EVENT_VOICE_MESSAGE_RECEIVED, [$event]);
                break;
            case Message::TYPE_NEW_CHAT_MEMBER:
            case Message::TYPE_LEFT_CHAT_MEMBER:
            case Message::TYPE_NEW_CHAT_TITLE:
            case Message::TYPE_NEW_CHAT_PHOTO:
            case Message::TYPE_DELETE_CHAT_PHOTO:
            case Message::TYPE_GROUP_CHAT_CREATED:
            case Message::TYPE_SUPERGROUP_CHAT_CREATED:
            case Message::TYPE_CHANNEL_CHAT_CREATED:
            case Message::TYPE_MESSAGE_PINNED:
                $this->bot->emit(MessageEvent::EVENT_SERVICE_MESSAGE_RECEIVED, [$event]);
                break;
            default:
                $this->bot->emit(MessageEvent::EVENT_UNKNOWN_TYPE_MESSAGE_RECEIVED, [$event]);
        }
    }
}