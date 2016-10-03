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
    const EVENT_TEXT_MESSAGE_RECEIVED = 'onTextMessageReceived';

    use EventEmitterTrait;

    protected $apiToken;

    protected $loop;
    protected $resolver;

    /** @var AbstractReceiver */
    protected $updater;
    /** @var Client */
    protected $client;

    protected $emitter;

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

    public final function onUpdateReceived(Update $update)
    {
        switch ($update->type) {
            case $update::TYPE_MESSAGE:
                $this->onMessageReceived($update->message);
                break;
            default:
        }
    }

    final public function onMessageReceived(Message $message)
    {
        switch ($message->type) {
            case $message::TYPE_TEXT:
                $this->onTextMessage($message);
                break;
            case $message::TYPE_AUDIO:
                $this->onAudioMessage($message);
                break;
            case $message::TYPE_DOCUMENT:
                $this->onDocumentMessage($message);
                break;
            case $message::TYPE_PHOTO:
                $this->onPhotoMessage($message);
                break;
            case $message::TYPE_NEW_CHAT_MEMBER:
            case $message::TYPE_LEFT_CHAT_MEMBER:
            case $message::TYPE_NEW_CHAT_TITLE:
            case $message::TYPE_NEW_CHAT_PHOTO:
            case $message::TYPE_DELETE_CHAT_PHOTO:
            case $message::TYPE_GROUP_CHAT_CREATED:
            case $message::TYPE_SUPERGROUP_CHAT_CREATED:
            case $message::TYPE_CHANNEL_CHAT_CREATED:
            case $message::TYPE_MESSAGE_PINNED:
                $this->onServiceMessage($message);
                break;
            default:
                $this->onUnknownTypeMessage($message);
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

    public function setReceiver(AbstractReceiver $updater)
    {
        $this->updater = $updater;
        $this->updater->setBot($this);
    }

    // Callbacks

    public function onTextMessage(Message $message)
    {
        $this->emit(static::EVENT_TEXT_MESSAGE_RECEIVED, [$message]);

        array_walk($message->entities, function(MessageEntity $entity) use ($message) {
            if ($entity->type === MessageEntity::TYPE_BOT_COMMAND) {
                $command = substr($message->text, $entity->offset, $entity->length);
                var_dump($command);
            }
        });
    }

    public function onAudioMessage(Message $message)
    {
    }

    public function onDocumentMessage(Message $message)
    {
    }

    public function onPhotoMessage(Message $message)
    {
    }

    public function onStickerMessage(Message $message)
    {
    }

    public function onVideoMessage(Message $message)
    {
    }

    public function onVoiceMessage(Message $message)
    {
    }

    public function onContactMessage(Message $message)
    {
    }

    public function onLocationMessage(Message $message)
    {
    }

    public function onVenueMessage(Message $message)
    {
    }

    public function onServiceMessage(Message $message)
    {
    }

    public function onUnknownTypeMessage(Message $message)
    {
    }
}