<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Tigris\Exceptions\TelegramApiException;
use Tigris\Helpers\TypeHelper;
use Tigris\Types\Arrays\ChatMemberArray;
use Tigris\Types\Arrays\UpdateArray;
use Tigris\Types\Chat;
use Tigris\Types\ChatMember;
use Tigris\Types\File;
use Tigris\Types\Inline\InlineQueryResult;
use Tigris\Types\Interfaces\ReplyMarkupInterface;
use Tigris\Types\Interfaces\TypeInterface;
use Tigris\Types\Message;
use Tigris\Types\Update;
use Tigris\Types\User;
use Tigris\Types\UserProfilePhotos;

class Api
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

    protected $apiToken;
    /** @var \GuzzleHttp\Client */
    protected $client;

    /**
     * Disabled default Api constructor.
     */
    protected function __construct()
    {

    }

    /**
     * @param string $apiToken
     * @return static
     */
    public static function create($apiToken)
    {
        $api = new static();
        $api->apiToken = $apiToken;
        $api->client = new Client([
            'base_uri' => 'https://api.telegram.org/bot' . $apiToken . '/',
            'timeout' => 10,
        ]);
        return $api;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Use this method to receive incoming updates using long polling.
     * {@see \Tigris\Types\Arrays\UpdateArray} object is returned.
     *
     * @link https://core.telegram.org/bots/api/#getting-updates
     *
     * @param integer|null $offset
     * @param integer|null $limit
     * @param integer|null $timeout
     * @return Update[]|UpdateArray
     */
    public function getUpdates(
        $offset = null,
        $limit = null,
        $timeout = null
    ) {
        $params = [
            'offset' => $offset,
            'limit' => $limit,
            'timeout' => $timeout,
        ];

        $data = $this->call('getUpdates', $params);
        return UpdateArray::build($data);
    }

    /**
     * A simple method for testing your bot's auth token. Requires no parameters.
     * Returns basic information about the bot in form of a {@see \Tigris\Types\User} object.
     *
     * @link https://core.telegram.org/bots/api#getme
     *
     * @return User
     */
    public function getMe()
    {
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return User::build($data);
    }

    /**
     * Use this method to send text messages.
     * On success, the sent {@see \Tigris\Types\Message} is returned.
     *
     * @link https://core.telegram.org/bots/api#sendmessage
     *
     * @param integer|string|Chat $chatId
     * @param string $text
     * @param string|null $parseMode
     * @param boolean|null $disableWebPagePreview
     * @param boolean|null $disableNotification
     * @param integer|Message|null $replyToMessageId
     * @param ReplyMarkupInterface|null $replyMarkup
     * @return Message
     */
    public function sendMessage(
        $chatId,
        $text,
        $parseMode = null,
        $disableWebPagePreview = null,
        $disableNotification = null,
        $replyToMessageId = null,
        ReplyMarkupInterface $replyMarkup = null
    ) {
        if ($chatId instanceof Chat) {
            $chatId = (string) $chatId;
        }

        $params = [
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => $parseMode,
            'disable_web_page_preview' => $disableWebPagePreview,
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'reply_markup' => $replyMarkup,
        ];
        $data = $this->call('sendMessage', $params);
        return Message::build($data);
    }

    /**
     * Use this method to forward messages of any kind.
     * On success, the sent {@see \Tigris\Types\Message} is returned.
     *
     * @link https://core.telegram.org/bots/api#forwardmessage
     *
     * @param integer|string|Chat $chatId
     * @param integer|string|Chat $fromChatId
     * @param integer|Message $messageId
     * @param boolean|null $disableNotification
     * @return Message
     */
    public function forwardMessage($chatId, $fromChatId, $messageId, $disableNotification = false)
    {
        $params = [
            'chat_id' => $chatId,
            'from_chat_id' => $fromChatId,
            'disable_notification' => $disableNotification,
            'message_id' => $messageId,
        ];
        $data = $this->call('forwardMessage', $params);
        return Message::build($data);
    }

    /**
     * Use this method to send photos.
     * On success, the sent {@see \Tigris\Types\Message} is returned.
     *
     * @link https://core.telegram.org/bots/api#sendphoto
     *
     * @param integer|string|Chat $chatId
     * @param string|resource $photo
     * @param string|null $caption
     * @param boolean|null $disableNotification
     * @param integer|Message|null $replyToMessageId
     * @param ReplyMarkupInterface|null $replyMarkup
     * @return Message
     */
    public function sendPhoto(
        $chatId,
        $photo,
        $caption = null,
        $disableNotification = null,
        $replyToMessageId = null,
        ReplyMarkupInterface $replyMarkup = null
    ) {
        $params = [
            'chat_id' => $chatId,
            'photo' => $photo,
            'caption' => $caption,
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'reply_markup' => $replyMarkup,
        ];
        $data = $this->call('sendPhoto', $params);
        return Message::build($data);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display them in the music player.
     * Your audio must be in the .mp3 format. On success, the sent {@see \Tigris\Types\Message} is returned.
     * Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future.
     *
     * @link https://core.telegram.org/bots/api#sendaudio
     *
     * @param integer|string|Chat $chatId
     * @param string|resource $audio
     * @param integer|null $duration
     * @param string|null $performer
     * @param string|null $title
     * @param boolean|null $disableNotification
     * @param integer|Message|null $replyToMessageId
     * @param ReplyMarkupInterface|null $replyMarkup
     * @return Message
     */
    public function sendAudio(
        $chatId,
        $audio,
        $duration = null,
        $performer = null,
        $title = null,
        $disableNotification = null,
        $replyToMessageId = null,
        ReplyMarkupInterface $replyMarkup = null
    ) {
        $params = [
            'chat_id' => $chatId,
            'audio' => $audio,
            'duration' => $duration,
            'performer' => $performer,
            'title' => $title,
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'reply_markup' => $replyMarkup,
        ];
        $data = $this->call('sendAudio', $params);
        return Message::build($data);
    }

    /**
     * Use this method to send general files. On success, the sent {@see \Tigris\Types\Message} is returned.
     * Bots can currently send files of any type of up to 50 MB in size, this limit may be changed in the future.
     *
     * @link https://core.telegram.org/bots/api#senddocument
     *
     * @param integer|string|Chat $chatId
     * @param string|resource $document
     * @param string|null $caption
     * @param boolean|null $disableNotification
     * @param integer|Message|null $replyToMessageId
     * @param ReplyMarkupInterface|null $replyMarkup
     * @return Message
     */
    public function sendDocument(
        $chatId,
        $document,
        $caption = null,
        $disableNotification = null,
        $replyToMessageId = null,
        ReplyMarkupInterface $replyMarkup = null
    ) {
        $params = [
            'chat_id' => $chatId,
            'document' => $document,
            'caption' => $caption,
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'reply_markup' => $replyMarkup,
        ];
        $data = $this->call('sendDocument', $params);
        return Message::build($data);
    }

    /**
     * Use this method to send .webp stickers.
     * On success, the sent {@see \Tigris\Types\Message} is returned.
     *
     * @link https://core.telegram.org/bots/api#sendsticker
     *
     * @param integer|string|Chat $chatId
     * @param string|resource $sticker
     * @param boolean|null $disableNotification
     * @param integer|Message|null $replyToMessageId
     * @param ReplyMarkupInterface|null $replyMarkup
     * @return Message
     */
    public function sendSticker(
        $chatId,
        $sticker,
        $disableNotification = null,
        $replyToMessageId = null,
        $replyMarkup = null
    ) {
        $params = [
            'chat_id' => $chatId,
            'sticker' => $sticker,
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'reply_markup' => $replyMarkup,
        ];
        $data = $this->call('sendSticker', $params);
        return Message::build($data);
    }

    /**
     * Use this method to send video files, Telegram clients support mp4 videos
     * (other formats may be sent as {@see Tigris\Types\Document}).
     * On success, the sent {@see \Tigris\Types\Message} is returned. Bots can currently send video files of up to
     * 50 MB in size, this limit may be changed in the future.
     *
     * @link https://core.telegram.org/bots/api#sendvideo
     *
     * @param integer|string|Chat $chatId
     * @param string|resource $video
     * @param integer|null $duration
     * @param integer|null $width
     * @param integer|null $height
     * @param string|null $caption
     * @param boolean|null $disableNotification
     * @param integer|Message|null $replyToMessageId
     * @param ReplyMarkupInterface|null $replyMarkup
     * @return Message
     */
    public function sendVideo(
        $chatId,
        $video,
        $duration = null,
        $width = null,
        $height = null,
        $caption = null,
        $disableNotification = null,
        $replyToMessageId = null,
        $replyMarkup = null
    ) {
        $params = [
            'chat_id' => $chatId,
            'video' => $video,
            'duration' => $duration,
            'width' => $width,
            'height' => $height,
            'caption' => $caption,
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'reply_markup' => $replyMarkup,
        ];
        $data = $this->call('sendVideo', $params);
        return Message::build($data);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display the file as a playable voice
     * message. For this to work, your audio must be in an .ogg file encoded with OPUS (other formats may be sent
     * as {@see \Tigris\Types\Audio} or {@see \Tigris\Types\Document}).
     * On success, the sent {@see \Tigris\Types\Message} is returned.
     * Bots can currently send voice messages of up to 50 MB in size, this limit may be changed in the future.
     *
     * @link https://core.telegram.org/bots/api#sendvoice
     *
     * @param integer|string|Chat $chatId
     * @param string|resource $voice
     * @param integer|null $duration
     * @param boolean|null $disableNotification
     * @param integer|Message|null $replyToMessageId
     * @param ReplyMarkupInterface|null $replyMarkup
     * @return Message
     */
    public function sendVoice(
        $chatId,
        $voice,
        $duration = null,
        $disableNotification = null,
        $replyToMessageId = null,
        $replyMarkup = null
    ) {
        $params = [
            'chat_id' => $chatId,
            'voice' => $voice,
            'duration' => $duration,
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'reply_markup' => $replyMarkup,
        ];
        $data = $this->call('sendVoice', $params);
        return Message::build($data);
    }

    /**
     * Use this method to send point on the map.
     * On success, the sent {@see \Tigris\Types\Message} is returned.
     *
     * @link https://core.telegram.org/bots/api#sendlocation
     *
     * @param integer|string|Chat $chatId
     * @param float $latitude
     * @param float $longitude
     * @param boolean|null $disableNotification
     * @param integer|Message|null $replyToMessageId
     * @param ReplyMarkupInterface|null $replyMarkup
     * @return Message
     */
    public function sendLocation(
        $chatId,
        $latitude,
        $longitude,
        $disableNotification = null,
        $replyToMessageId = null,
        $replyMarkup = null
    ) {
        $params = [
            'chat_id' => $chatId,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'reply_markup' => $replyMarkup,
        ];
        $data = $this->call('sendLocation', $params);
        return Message::build($data);
    }

    /**
     * Use this method to send information about a venue.
     * On success, the sent {@see \Tigris\Types\Message} is returned.
     *
     * @link https://core.telegram.org/bots/api#sendvenue
     *
     * @param integer|string|Chat $chatId
     * @param float $latitude
     * @param float $longitude
     * @param string $title
     * @param string $address
     * @param string $foursquareId
     * @param boolean|null $disableNotification
     * @param integer|Message|null $replyToMessageId
     * @param ReplyMarkupInterface|null $replyMarkup
     * @return Message
     */
    public function sendVenue(
        $chatId,
        $latitude,
        $longitude,
        $title,
        $address,
        $foursquareId,
        $disableNotification = null,
        $replyToMessageId = null,
        $replyMarkup = null
    ) {
        $params = [
            'chat_id' => $chatId,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'title' => $title,
            'address' => $address,
            'foursquare_id' => $foursquareId,
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'reply_markup' => $replyMarkup,
        ];
        $data = $this->call('sendVenue', $params);
        return Message::build($data);
    }

    /**
     * Use this method to send phone contacts.
     * On success, the sent {@see \Tigris\Types\Message} is returned.
     *
     * @link https://core.telegram.org/bots/api#sendcontact
     *
     * @param integer|string|Chat $chatId
     * @param string $phoneNumber
     * @param string $firstName
     * @param string|null $lastName
     * @param boolean|null $disableNotification
     * @param integer|Message|null $replyToMessageId
     * @param ReplyMarkupInterface|null $replyMarkup
     * @return Message
     */
    public function sendContact(
        $chatId,
        $phoneNumber,
        $firstName,
        $lastName = null,
        $disableNotification = null,
        $replyToMessageId = null,
        $replyMarkup = null
    ) {
        $params = [
            'chat_id' => $chatId,
            'phone_number' => $phoneNumber,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'reply_markup' => $replyMarkup,
        ];
        $data = $this->call('sendContact', $params);
        return Message::build($data);
    }

    /**
     * Use this method when you need to tell the user that something is happening on the bot's side. The status
     * is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status).
     *
     * @link https://core.telegram.org/bots/api#sendchataction
     *
     * @param integer|Chat $chatId
     * @param string $action
     * @return true
     */
    public function sendChatAction(
        $chatId,
        $action
    ) {
        $params = [
            'chat_id' => $chatId,
            'action' => $action,
        ];
        return (bool) $this->call('sendChatAction', $params);
    }

    /**
     * Use this method to get a list of profile pictures for a user.
     * Returns a {@see \Tigris\Types\UserProfilePhotos} object.
     *
     * @link https://core.telegram.org/bots/api#getuserprofilephotos
     *
     * @param integer $userId
     * @param integer $offset
     * @param integer $limit
     * @return UserProfilePhotos
     */
    public function getUserProfilePhotos(
        $userId,
        $offset = null,
        $limit = null
    ) {
        $params = [
            'user_id' => $userId,
            'offset' => $offset,
            'limit' => $limit,
        ];
        $data = $this->call('sendChatAction', $params);
        return UserProfilePhotos::build($data);
    }

    /**
     * Use this method to get basic info about a file and prepare it for downloading.
     * For the moment, bots can download files of up to 20MB in size.
     * On success, a File object is returned.
     *
     * @link https://core.telegram.org/bots/api#getfile
     *
     * @param integer $fileId
     * @return File
     */
    public function getFile(
        $fileId
    ) {
        $params = [
            'file_id' => $fileId,
        ];
        $data = $this->call('getFile', $params);
        return File::build($data);
    }

    /**
     * Use this method to kick a user from a group or a supergroup. In the case of supergroups, the user will not
     * be able to return to the group on their own using invite links, etc., unless unbanned first. The bot must be
     * an administrator in the group for this to work. Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#kickchatmember
     *
     * @param integer|string|Chat $chatId
     * @param integer|User $userId
     * @return true
     */
    public function kickChatMember(
        $chatId,
        $userId
    ) {
        $params = [
            'chat_id' => $chatId,
            'user_id' => $userId,
        ];
        return (bool) $this->call('kickChatMember', $params);
    }

    /**
     * Use this method for your bot to leave a group, supergroup or channel.
     * Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#leavechat
     *
     * @param integer|string|Chat $chatId
     * @return true
     */
    public function leaveChat(
        $chatId
    ) {
        $params = [
            'chat_id' => $chatId,
        ];
        return (bool) $this->call('leaveChat', $params);
    }

    /**
     * Use this method to unban a previously kicked user in a supergroup. The user will not return to the group
     * automatically, but will be able to join via link, etc. The bot must be an administrator in the group for this
     * to work. Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#unbanchatmember
     *
     * @param integer|string $chatId
     * @param integer $userId
     * @return true
     */
    public function unbanChatMember(
        $chatId,
        $userId
    ) {
        $params = [
            'chat_id' => $chatId,
            'user_id' => $userId,
        ];
        return (bool) $this->call('unbanChatMember', $params);
    }

    /**
     * Use this method to get up to date information about the chat (current name of the user for one-on-one
     * conversations, current username of a user, group or channel, etc.).
     * Returns a {@see \Tigris\Types\Chat} object on success.
     *
     * @link https://core.telegram.org/bots/api#getchat
     *
     * @param integer|string|Chat $chatId
     * @return Chat
     */
    public function getChat(
        $chatId
    ) {
        $params = [
            'chat_id' => $chatId,
        ];
        return Chat::build($this->call('getChat', $params));
    }

    /**
     * Use this method to get a list of administrators in a chat. On success, returns an Array of ChatMember objects
     * that contains information about all chat administrators except other bots. If the chat is a group or a
     * supergroup and no administrators were appointed, only the creator will be returned.
     *
     * @link https://core.telegram.org/bots/api#getchatadministrators
     *
     * @param integer|string|Chat $chatId
     * @return ChatMemberArray
     */
    public function getChatAdministrators(
        $chatId
    ) {
        $params = [
            'chat_id' => $chatId,
        ];
        return ChatMemberArray::build($this->call('getChatAdministrators', $params));
    }

    /**
     * Use this method to get the number of members in a chat.
     * Returns Int on success.
     *
     * @link https://core.telegram.org/bots/api#getchatmemberscount
     *
     * @param integer|string|Chat $chatId
     * @return integer
     */
    public function getChatMembersCount(
        $chatId
    ) {
        $params = [
            'chat_id' => $chatId,
        ];
        return (integer) $this->call('getChatMembersCount', $params);
    }

    /**
     * Use this method to get information about a member of a chat.
     * Returns a {@see \Tigris\Types\ChatMember} object on success.
     *
     * @link https://core.telegram.org/bots/api#getchatmember
     *
     * @param integer|string|Chat $chatId
     * @param integer|string|User $userId
     * @return ChatMember
     */
    public function getChatMember(
        $chatId,
        $userId
    ) {
        $params = [
            'chat_id' => $chatId,
            'user_id' => $userId,
        ];
        return ChatMember::build($this->call('getChatMember', $params));
    }

    /**
     * Use this method to send answers to callback queries sent from inline keyboards.
     * The answer will be displayed to the user as a notification at the top of the chat screen or as an alert.
     * On success, True is returned.
     *
     * @link https://core.telegram.org/bots/api#answercallbackquery
     *
     * @param string $callbackQueryId
     * @param string $text
     * @param boolean $showAlert
     * @param string $url
     * @return true
     */
    public function answerCallbackQuery(
        $callbackQueryId,
        $text,
        $showAlert,
        $url = null
    ) {
        $params = [
            'callback_query_id' => $callbackQueryId,
            'text' => $text,
            'show_alert' => $showAlert,
            'url' => $url,
        ];
        return (bool) $this->call('answerCallbackQuery', $params);
    }

    /**
     * Use this method to send answers to callback queries sent from inline keyboards.
     * The answer will be displayed to the user as a notification at the top of the chat screen or as an alert.
     * On success, True is returned.
     *
     * @link https://core.telegram.org/bots/api#answerinlinequery
     *
     * @param string $inline_query_id Unique identifier for the answered query.
     * @param InlineQueryResult[] $results A JSON-serialized array of results for the inline query.
     * @param integer $cache_time Optional. The maximum amount of time in seconds that the result of the inline query
     *  may be cached on the server. Defaults to 300.
     * @param boolean $is_personal Optional. Pass True, if results may be cached on the server side only for the user
     *  that sent the query. By default, results may be returned to any user who sends the same query
     * @param string $next_offset Optional. Pass the offset that a client should send in the next query with the same
     *  text to receive more results. Pass an empty string if there are no more results or if you don‘t support
     *  pagination. Offset length can’t exceed 64 bytes.
     * @param string $switch_pm_text Optional. If passed, clients will display a button with specified text that
     *  switches the user to a private chat with the bot and sends the bot a start message with the parameter
     *  switch_pm_parameter
     * @param string $switch_pm_parameter Parameter for the start message sent to the bot when user presses the
     *  switch button
     * @return true
     */
    public function answerInlineQuery(
        $inline_query_id,
        $results,
        $cache_time = null,
        $is_personal = null,
        $next_offset = null,
        $switch_pm_text = null,
        $switch_pm_parameter = null
    ) {
        return (bool) $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
    }

    /**
     * @param $method
     * @param array $args
     * @return array
     */
    protected function parseArgs($method, array $args)
    {
        $method =  new \ReflectionMethod(static::class, $method);
        $result = [];
        foreach ($method->getParameters() as $i=>$p) {
            $result[$p->getName()] = isset($args[$i]) ? $args[$i] : null;
        }
        return $result;
    }

    /**
     * @param $methodName
     * @param null|array $params
     * @return mixed
     */
    protected function call($methodName, $params = [])
    {
        // removing empty params
        $query = array_filter($params);

        // detecting if we need to use multipart/form-data
        $multipart = array_reduce($params, function($carry, $item) {
            return $carry || is_resource($item);
        }, false);

        // converting existing types to arrays if needed
        array_walk($query, function (&$item) {
            if ($item instanceof TypeInterface) {
                $item = TypeHelper::jsonEncode($item, false);
            }
        });

        if ($multipart) {
            $query = array_map(function($key, $item) {
                return [
                    'name' => $key,
                    'contents' => $item,
                ];
            }, array_keys($params), $params);
            $options = array_filter([
                'multipart' => $query,
            ]);
        } else {
            $options = array_filter([
                'json' => $query,
            ]);
        }

        $response = $this->client->post($methodName, $options);
        return $this->parseResponse($response);
    }

    /**
     * @param ResponseInterface $response
     * @return mixed
     * @throws TelegramApiException
     */
    protected function parseResponse(ResponseInterface $response)
    {
        $data = json_decode($response->getBody()->getContents(), true);
        if ($data === null || $data['ok'] != true) {
            throw new TelegramApiException('Request failure');
        }

        return $data['result'];
    }
}