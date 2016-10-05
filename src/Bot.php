<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris;

use Evenement\EventEmitterTrait;
use GuzzleHttp\Client;
use React\Dns\Resolver\Factory as ResolverFactory;
use React\EventLoop\Factory as EventLoopFactory;
use React\EventLoop\LoopInterface;
use Tigris\Receivers\AbstractReceiver;
use Tigris\Telegram\Api;
use Tigris\Types\Message;
use Tigris\Types\MessageEntity;
use Tigris\Types\Update;

abstract class Bot
{
    use EventEmitterTrait;

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

    protected $apiToken;

    protected $loop;
    protected $resolver;

    /** @var AbstractReceiver */
    protected $receiver;
    /** @var Client */
    protected $client;
    /** @var Api */
    protected $api;

    /** @var UpdatesQueue */
    protected $updatesQueue;

    final protected function __construct()
    {
        $this->loop = EventLoopFactory::create();
        $this->resolver = (new ResolverFactory())->createCached('8.8.8.8', $this->loop);
        $this->updatesQueue = new UpdatesQueue();
    }

    /**
     * @param string $apiToken
     * @return static
     */
    final public static function create($apiToken)
    {
        $bot = new static();
        $bot->api = Api::create($apiToken);
        return $bot;
    }

    final public function run()
    {
        $this->loop->addPeriodicTimer(0.1, function () {
            while (!$this->updatesQueue->isEmpty()) {
                $item = $this->updatesQueue->extract();
                $this->onUpdateReceived($item);
            }
        });

        $this->loop->run();
    }

    /**
     * @param Update $update
     */
    protected final function onUpdateReceived(Update $update)
    {
        switch ($update->type) {
            case $update::TYPE_MESSAGE:
                $this->onMessageReceived($update->message);
                break;
            // TODO: add support for other update types
            default:
        }
    }

    /**
     * @param Message $message
     */
    protected final function onMessageReceived(Message $message)
    {
        switch ($message->type) {
            case Message::TYPE_AUDIO:
                $this->emit(self::EVENT_AUDIO_MESSAGE_RECEIVED, [$message]);
                break;
            case Message::TYPE_CONTACT:
                $this->emit(self::EVENT_CONTACT_MESSAGE_RECEIVED, [$message]);
                break;
            case Message::TYPE_DOCUMENT:
                $this->emit(self::EVENT_DOCUMENT_MESSAGE_RECEIVED, [$message]);
                break;
            case Message::TYPE_LOCATION:
                $this->emit(self::EVENT_LOCATION_MESSAGE_RECEIVED, [$message]);
                break;
            case Message::TYPE_PHOTO:
                $this->emit(self::EVENT_PHOTO_MESSAGE_RECEIVED, [$message]);
                break;
            case Message::TYPE_STICKER:
                $this->emit(self::EVENT_STICKER_MESSAGE_RECEIVED, [$message]);
                break;
            case Message::TYPE_TEXT:
                $this->emit(self::EVENT_TEXT_MESSAGE_RECEIVED, [$message]);
                break;
            case Message::TYPE_VENUE:
                $this->emit(self::EVENT_VENUE_MESSAGE_RECEIVED, [$message]);
                break;
            case Message::TYPE_VIDEO:
                $this->emit(self::EVENT_VIDEO_MESSAGE_RECEIVED, [$message]);
                break;
            case Message::TYPE_VOICE:
                $this->emit(self::EVENT_VOICE_MESSAGE_RECEIVED, [$message]);
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
                $this->emit(self::EVENT_SERVICE_MESSAGE_RECEIVED, [$message]);
                break;
            default:
                $this->emit(self::EVENT_UNKNOWN_TYPE_MESSAGE_RECEIVED, [$message]);
        }
    }

    /**
     * @return LoopInterface
     */
    public function getLoop()
    {
        return $this->loop;
    }

    /**
     * @return UpdatesQueue
     */
    public function getUpdatesQueue()
    {
        return $this->updatesQueue;
    }

    /**
     * @return Api
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * @param AbstractReceiver $receiver
     */
    public function setReceiver(AbstractReceiver $receiver)
    {
        $this->receiver = $receiver;
        $this->receiver->setBot($this);
    }

    // TODO: move to plugin

    public function onTextMessage(Message $message)
    {
        array_walk($message->entities, function(MessageEntity $entity) use ($message) {
            if ($entity->type === MessageEntity::TYPE_BOT_COMMAND) {
                $command = substr($message->text, $entity->offset, $entity->length);
                var_dump($command);
            }
        });
    }
}