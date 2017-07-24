<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram;

use Tigris\Telegram\Types\Arrays\ChatMemberArray;
use Tigris\Telegram\Types\Arrays\UpdateArray;
use Tigris\Telegram\Types\Chat;
use Tigris\Telegram\Types\ChatMember;
use Tigris\Telegram\Types\File;
use Tigris\Telegram\Types\Interfaces\TypeInterface;
use Tigris\Telegram\Types\Message;
use Tigris\Telegram\Types\Scalar\ScalarBoolean;
use Tigris\Telegram\Types\Scalar\ScalarInteger;
use Tigris\Telegram\Types\Update;
use Tigris\Telegram\Types\User;
use Tigris\Telegram\Types\UserProfilePhotos;
use Tigris\Telegram\Types\WebhookInfo;

/**
 * Class ApiWrapper
 * @package Tigris\Telegram
 *
 * @method null|Update[] getUpdates(array $params)
 * @method null|true setWebhook(array $params)
 * @method null|true deleteWebhook(array $params)
 * @method null|WebhookInfo getWebhookInfo(array $params)
 *
 * @method null|User getMe()
 *
 * @method null|Message sendMessage(array $params)
 * @method null|Message forwardMessage(array $params)
 * @method null|Message sendPhoto(array $params)
 * @method null|Message sendAudio(array $params)
 * @method null|Message sendDocument(array $params)
 * @method null|Message sendSticker(array $params)
 * @method null|Message sendVideo(array $params)
 * @method null|Message sendLocation(array $params)
 * @method null|Message sendVenue(array $params)
 * @method null|Message sendContact(array $params)
 * @method null|Message sendGame(array $params)
 *
 * @method null|true sendChatAction(array $params)
 * @method null|UserProfilePhotos getUserProfilePhotos(array $params)
 * @method null|File getFile(array $params)
 * @method null|true kickChatMember(array $params)
 * @method null|true leaveChat(array $params)
 * @method null|true unbanChatMember(array $params)
 * @method null|Chat getChat(array $params)
 * @method null|ChatMemberArray getChatAdministrators(array $params)
 * @method null|integer getChatMembersCount(array $params)
 * @method null|ChatMember getChatMember(array $params)
 * @method null|true answerCallbackQuery(array $params)
 * @method null|true answerInlineQuery(array $params)
 */
class ApiWrapper
{
    const METHODS = [
        // updates methods
        'getUpdates' => UpdateArray::class,
        'setWebhook' => ScalarBoolean::class,
        'deleteWebhook' => ScalarBoolean::class,
        'getWebhookInfo' => WebhookInfo::class,
        'getMe' => User::class,
        'sendMessage' => Message::class,
        'forwardMessage' => Message::class,
        'sendPhoto' => Message::class,
        'sendDocument' => Message::class,
        'sendSticker' => Message::class,
        'sendVideo' => Message::class,
        'sendVoice' => Message::class,
        'sendLocation' => Message::class,
        'sendVenue' => Message::class,
        'sendContact' => Message::class,
        'sendChatAction' => ScalarBoolean::class,
        'getUserProfilePhotos' => UserProfilePhotos::class,
        'getFile' => File::class,
        'kickChatMember' => ScalarBoolean::class,
        'leaveChat' => ScalarBoolean::class,
        'unbanChatMember' => ScalarBoolean::class,
        'getChat' => Chat::class,
        'getChatAdministrators' => ChatMemberArray::class,
        'getChatMembersCount' => ScalarInteger::class,
        'getChatMember' => ChatMember::class,
        'answerCallbackQuery' => ScalarBoolean::class,
        'answerInlineQuery' => ScalarBoolean::class,
        'sendGame' => Message::class,
    ];

    /** @var callable */
    protected $errorHandler;

    /** @var ApiClient */
    protected $apiClient;

    /**
     * @param ApiClient $apiClient
     */
    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * @param callable $errorHandler
     */
    public function setErrorHandler(callable $errorHandler)
    {
        $this->errorHandler = $errorHandler;
    }

    /**
     * @param string $methodName
     * @param string $arguments
     * @return TypeInterface|null
     */
    function __call($methodName, $arguments)
    {
        if (!array_key_exists($methodName, self::METHODS)) {
            throw new \BadMethodCallException('Unsupported method: ' . $methodName);
        }

        $response = null;
        try {
            $response = $this->apiClient->call($methodName, $arguments);
        } catch (\Exception $e) {
            if (is_callable($this->errorHandler)) {
                call_user_func($this->errorHandler, $e);
            }
        }

        return $this->parseResponse($methodName, $response);
    }

    /**
     * @param $methodName
     * @param null|array $response
     * @return null|TypeInterface
     */
    protected function parseResponse($methodName, $response)
    {
        if ($response == null) {
            return null;
        }
        /** @var TypeInterface $type */
        $type = self::METHODS[$methodName];
        return $type::parse($response);
    }
}