<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Events;

use Tigris\Telegram\Types\Message;

class MessageEvent extends AbstractEvent
{
    // generic event
    const EVENT_MESSAGE_RECEIVED = 'onMessageReceived';
    // message type events
    const EVENT_AUDIO_MESSAGE_RECEIVED = 'onAudioMessageReceived';
    const EVENT_CONTACT_MESSAGE_RECEIVED = 'onContactMessageReceived';
    const EVENT_DOCUMENT_MESSAGE_RECEIVED = 'onDocumentMessageReceived';
    const EVENT_LOCATION_MESSAGE_RECEIVED = 'onLocationMessageReceived';
    const EVENT_PHOTO_MESSAGE_RECEIVED = 'onPhotoMessageReceived';
    const EVENT_STICKER_MESSAGE_RECEIVED = 'onStickerMessageReceived';
    const EVENT_TEXT_MESSAGE_RECEIVED = 'onTextMessageReceived';
    const EVENT_VIDEO_MESSAGE_RECEIVED = 'onVideoMessageReceived';
    const EVENT_VENUE_MESSAGE_RECEIVED = 'onVenueMessageReceived';
    const EVENT_VOICE_MESSAGE_RECEIVED = 'onVoiceMessageReceived';
    const EVENT_SERVICE_MESSAGE_RECEIVED = 'onServiceMessageReceived';
    const EVENT_UNKNOWN_TYPE_MESSAGE_RECEIVED = 'onUnknownTypeMessageReceived';

    /** @var Message */
    public $message;

    /**
     * @param Message $message
     * @return static
     */
    public static function create(Message $message)
    {
        $event = new static();
        $event->message = $message;
        return $event;
    }
}