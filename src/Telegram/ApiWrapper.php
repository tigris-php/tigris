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

/**
 * Class ApiWrapper
 * @package Tigris\Telegram
 *
 *
 */
class ApiWrapper
{
    const PARSE_MODE_MARKDOWN = 'Markdown';
    const PARSE_MODE_HTML = 'HTML';

    /** @see sendChatAction() */
    const CHAT_ACTION_TYPING = 'typing';
    const CHAT_ACTION_UPLOAD_PHOTO = 'upload_photo';
    const CHAT_ACTION_RECORD_VIDEO = 'record_video';
    const CHAT_ACTION_UPLOAD_VIDEO = 'upload_video';
    const CHAT_ACTION_RECORD_AUDIO = 'record_audio';
    const CHAT_ACTION_UPLOAD_AUDIO = 'upload_audio';
    const CHAT_ACTION_UPLOAD_DOCUMENT = 'upload_document';
    const CHAT_ACTION_FIND_LOCATION = 'find_location';

    const METHODS = [
        'getUpdates' => UpdateArray::class,
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

    /** @var ApiClient */
    protected $apiClient;

    /**
     * @param ApiClient $apiClient
     */
    public function __construct(ApiClient $apiClient)
    {
        $this->setApiClient($apiClient);
    }

    /**
     * @param ApiClient $apiClient
     */
    public function setApiClient(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * @param string $methodName
     * @param string $arguments
     */
    function __call($methodName, $arguments)
    {
        $this->callInternal($methodName, $arguments);
    }

    /**
     * @param string $methodName
     * @param array|null $arguments
     * @return TypeInterface|null
     */
    protected function callInternal($methodName, $arguments = [])
    {
        if (!array_key_exists($methodName, self::METHODS)) {
            throw new \BadMethodCallException('Unsupported method: ' . $methodName);
        }
        $response = $this->apiClient->call($methodName, $arguments);
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

    /**
     * Use this method to receive incoming updates using long polling.
     *
     * An array of {@see \Tigris\Telegram\Types\Update} objects is returned.
     *
     * @link https://core.telegram.org/bots/api/#getupdates
     *
     * @param array $params
     * @return null|TypeInterface|Update[]|UpdateArray
     */
    public function getUpdates(array $params)
    {
        return $this->callInternal(__FUNCTION__, $params);
    }

    /**
     * A simple method for testing your bot's auth token. Requires no parameters.
     * Returns basic information about the bot in form of a {@see \Tigris\Telegram\Types\User} object.
     *
     * @link https://core.telegram.org/bots/api#getme
     *
     * @return null|TypeInterface|User
     */
    public function getMe()
    {
        return $this->callInternal(__FUNCTION__);
    }

    /**
     * Use this method to send text messages.
     * On success, the sent {@see \Tigris\Telegram\Types\Message} is returned.
     *
     * @link https://core.telegram.org/bots/api#sendmessage
     *
     * @param array @params
     * @return null|TypeInterface|Message
     */
    public function sendMessage(array $params)
    {
        return $this->callInternal(__FUNCTION__, $params);
    }

    /**
     * Use this method to forward messages of any kind.
     * On success, the sent {@see \Tigris\Telegram\Types\Message} is returned.
     *
     * @link https://core.telegram.org/bots/api#forwardmessage
     *
     * @param array @params
     * @return null|TypeInterface|Message
     */
    public function forwardMessage(array $params)
    {
        return $this->callInternal(__FUNCTION__, $params);
    }

    /**
     * Use this method to send photos.
     * On success, the sent {@see \Tigris\Telegram\Types\Message} is returned.
     *
     * @link https://core.telegram.org/bots/api#sendphoto
     *
     * @param array @params
     * @return null|TypeInterface|Message
     */
    public function sendPhoto(array $params)
    {
        return $this->callInternal(__FUNCTION__, $params);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display them in the music player.
     * Your audio must be in the .mp3 format. On success, the sent {@see \Tigris\Telegram\Types\Message} is returned.
     * Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future.
     *
     * @link https://core.telegram.org/bots/api#sendaudio
     *
     * @param array @params
     * @return null|TypeInterface|Message
     */
    public function sendAudio(array $params)
    {
        return $this->callInternal(__FUNCTION__, $params);
    }

    /**
     * Use this method to send general files. On success, the sent {@see \Tigris\Telegram\Types\Message} is returned.
     * Bots can currently send files of any type of up to 50 MB in size, this limit may be changed in the future.
     *
     * @link https://core.telegram.org/bots/api#senddocument
     *
     * @param array @params
     * @return null|TypeInterface|Message
     */
    public function sendDocument(array $params)
    {
        return $this->callInternal(__FUNCTION__, $params);
    }

    /**
     * Use this method to send .webp stickers.
     * On success, the sent {@see \Tigris\Telegram\Types\Message} is returned.
     *
     * @link https://core.telegram.org/bots/api#sendsticker
     *
     * @param array @params
     * @return null|TypeInterface|Message
     */
    public function sendSticker(array $params)
    {
        return $this->callInternal(__FUNCTION__, $params);
    }

    /**
     * Use this method to send video files, Telegram clients support mp4 videos
     * (other formats may be sent as {@see Tigris\Types\Document}).
     * On success, the sent {@see \Tigris\Telegram\Types\Message} is returned. Bots can currently send video files of up to
     * 50 MB in size, this limit may be changed in the future.
     *
     * @link https://core.telegram.org/bots/api#sendvideo
     *
     * @param array @params
     * @return null|TypeInterface|Message
     */
    public function sendVideo(array $params)
    {
        return $this->callInternal(__FUNCTION__, $params);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display the file as a playable voice
     * message. For this to work, your audio must be in an .ogg file encoded with OPUS (other formats may be sent
     * as {@see \Tigris\Telegram\Types\Audio} or {@see \Tigris\Telegram\Types\Document}).
     * On success, the sent {@see \Tigris\Telegram\Types\Message} is returned.
     * Bots can currently send voice messages of up to 50 MB in size, this limit may be changed in the future.
     *
     * @link https://core.telegram.org/bots/api#sendvoice
     *
     * @param array @params
     * @return null|TypeInterface|Message
     */
    public function sendVoice(array $params)
    {
        return $this->callInternal(__FUNCTION__, $params);
    }

    /**
     * Use this method to send point on the map.
     * On success, the sent {@see \Tigris\Telegram\Types\Message} is returned.
     *
     * @link https://core.telegram.org/bots/api#sendlocation
     *
     * @param array @params
     * @return null|TypeInterface|Message
     */
    public function sendLocation(array $params)
    {
        return $this->callInternal(__FUNCTION__, $params);
    }

    /**
     * Use this method to send information about a venue.
     * On success, the sent {@see \Tigris\Telegram\Types\Message} is returned.
     *
     * @link https://core.telegram.org/bots/api#sendvenue
     *
     * @param array @params
     * @return null|TypeInterface|Message
     */
    public function sendVenue(array $params)
    {
        return $this->callInternal(__FUNCTION__, $params);
    }

    /**
     * Use this method to send phone contacts.
     * On success, the sent {@see \Tigris\Telegram\Types\Message} is returned.
     *
     * @link https://core.telegram.org/bots/api#sendcontact
     *
     * @param array @params
     * @return null|TypeInterface|Message
     */
    public function sendContact(array $params)
    {
        return $this->callInternal(__FUNCTION__, $params);
    }

    /**
     * Use this method when you need to tell the user that something is happening on the bot's side. The status
     * is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status).
     *
     * @link https://core.telegram.org/bots/api#sendchataction
     *
     * @param array @params
     * @return null|TypeInterface|true
     */
    public function sendChatAction(array $params)
    {
        return $this->callInternal(__FUNCTION__, $params);
    }

    /**
     * Use this method to get a list of profile pictures for a user.
     * Returns a {@see \Tigris\Telegram\Types\UserProfilePhotos} object.
     *
     * @link https://core.telegram.org/bots/api#getuserprofilephotos
     *
     * @param array @params
     * @return null|TypeInterface|UserProfilePhotos
     */
    public function getUserProfilePhotos(array $params)
    {
        return $this->callInternal(__FUNCTION__, $params);
    }

    /**
     * Use this method to get basic info about a file and prepare it for downloading.
     * For the moment, bots can download files of up to 20MB in size.
     * On success, a {@see \Tigris\Telegram\Types\File} object is returned.
     *
     * @link https://core.telegram.org/bots/api#getfile
     *
     * @param array @params
     * @return null|TypeInterface|File
     */
    public function getFile(array $params)
    {
        return $this->callInternal(__FUNCTION__, $params);
    }

    /**
     * Use this method to kick a user from a group or a supergroup. In the case of supergroups, the user will not
     * be able to return to the group on their own using invite links, etc., unless unbanned first. The bot must be
     * an administrator in the group for this to work. Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#kickchatmember
     *
     * @param array @params
     * @return null|TypeInterface|true
     */
    public function kickChatMember(array $params)
    {
        return $this->callInternal(__FUNCTION__, $params);
    }

    /**
     * Use this method for your bot to leave a group, supergroup or channel.
     * Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#leavechat
     *
     * @param array @params
     * @return null|TypeInterface|true
     */
    public function leaveChat(array $params)
    {
        return $this->callInternal(__FUNCTION__, $params);
    }

    /**
     * Use this method to unban a previously kicked user in a supergroup. The user will not return to the group
     * automatically, but will be able to join via link, etc. The bot must be an administrator in the group for this
     * to work. Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#unbanchatmember
     *
     * @param array @params
     * @return null|TypeInterface|true
     */
    public function unbanChatMember(array $params)
    {
        return $this->callInternal(__FUNCTION__, $params);
    }

    /**
     * Use this method to get up to date information about the chat (current name of the user for one-on-one
     * conversations, current username of a user, group or channel, etc.).
     * Returns a {@see \Tigris\Telegram\Types\Chat} object on success.
     *
     * @link https://core.telegram.org/bots/api#getchat
     *
     * @param array @params
     * @return null|TypeInterface|Chat
     */
    public function getChat(array $params)
    {
        return $this->callInternal(__FUNCTION__, $params);
    }

    /**
     * Use this method to get a list of administrators in a chat. On success, returns an Array of ChatMember objects
     * that contains information about all chat administrators except other bots. If the chat is a group or a
     * supergroup and no administrators were appointed, only the creator will be returned.
     *
     * @link https://core.telegram.org/bots/api#getchatadministrators
     *
     * @param array @params
     * @return null|TypeInterface|ChatMember[]|ChatMemberArray
     */
    public function getChatAdministrators(array $params)
    {
        return $this->callInternal(__FUNCTION__, $params);
    }

    /**
     * Use this method to get the number of members in a chat.
     * Returns Int on success.
     *
     * @link https://core.telegram.org/bots/api#getchatmemberscount
     *
     * @param array @params
     * @return null|TypeInterface|integer
     */
    public function getChatMembersCount(array $params)
    {
        return $this->callInternal(__FUNCTION__, $params);
    }

    /**
     * Use this method to get information about a member of a chat.
     * Returns a {@see \Tigris\Telegram\Types\ChatMember} object on success.
     *
     * @link https://core.telegram.org/bots/api#getchatmember
     *
     * @param array @params
     * @return null|TypeInterface|ChatMember
     */
    public function getChatMember(array $params)
    {
        return $this->callInternal(__FUNCTION__, $params);
    }

    /**
     * Use this method to send answers to callback queries sent from inline keyboards.
     * The answer will be displayed to the user as a notification at the top of the chat screen or as an alert.
     * On success, True is returned.
     *
     * @link https://core.telegram.org/bots/api#answercallbackquery
     *
     * @param array @params
     * @return null|TypeInterface|true
     */
    public function answerCallbackQuery(array $params)
    {
        return $this->callInternal(__FUNCTION__, $params);
    }

    /**
     * Use this method to send answers to callback queries sent from inline keyboards.
     * The answer will be displayed to the user as a notification at the top of the chat screen or as an alert.
     * On success, True is returned.
     *
     * @link https://core.telegram.org/bots/api#answerinlinequery
     *
     * @param array @params
     * @return null|TypeInterface|true
     */
    public function answerInlineQuery(array $params)
    {
        return $this->callInternal(__FUNCTION__, $params);
    }

    /**
     * Use this method to send a game.
     * On success, the sent {@see \Tigris\Telegram\Types\Message} is returned.
     *
     * @link https://core.telegram.org/bots/api#sendgame
     *
     * @param array @params
     * @return null|TypeInterface|Message
     */
    public function sendGame(array $params)
    {
        return $this->callInternal(__FUNCTION__, $params);
    }
}