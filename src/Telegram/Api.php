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
use Tigris\Types\Scalar\ScalarBoolean;
use Tigris\Types\Scalar\ScalarInteger;
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
     * An array of {@see \Tigris\Types\Update} objects is returned.
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
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return UpdateArray::parse($data);
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
        return User::parse($data);
    }

    /**
     * Use this method to send text messages.
     * On success, the sent {@see \Tigris\Types\Message} is returned.
     *
     * @link https://core.telegram.org/bots/api#sendmessage
     *
     * @param integer|string $chat_id
     * @param string $text
     * @param string|null $parse_mode
     * @param boolean|null $disable_web_page_preview
     * @param boolean|null $disable_notification
     * @param integer|null $reply_to_message_id
     * @param ReplyMarkupInterface|null $reply_markup
     * @return Message
     */
    public function sendMessage(
        $chat_id,
        $text,
        $parse_mode = null,
        $disable_web_page_preview = null,
        $disable_notification = null,
        $reply_to_message_id = null,
        ReplyMarkupInterface $reply_markup = null
    ) {
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return Message::parse($data);
    }

    /**
     * Use this method to forward messages of any kind.
     * On success, the sent {@see \Tigris\Types\Message} is returned.
     *
     * @link https://core.telegram.org/bots/api#forwardmessage
     *
     * @param integer|string $chat_id
     * @param integer|string $from_chat_id
     * @param integer $message_id
     * @param boolean|null $disable_notification
     * @return Message
     */
    public function forwardMessage($chat_id, $from_chat_id, $message_id, $disable_notification = null)
    {
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return Message::parse($data);
    }

    /**
     * Use this method to send photos.
     * On success, the sent {@see \Tigris\Types\Message} is returned.
     *
     * @link https://core.telegram.org/bots/api#sendphoto
     *
     * @param integer|string $chat_id
     * @param string|resource $photo
     * @param string|null $caption
     * @param boolean|null $disable_notification
     * @param integer|null $reply_to_message_id
     * @param ReplyMarkupInterface|null $reply_markup
     * @return Message
     */
    public function sendPhoto(
        $chat_id,
        $photo,
        $caption = null,
        $disable_notification = null,
        $reply_to_message_id = null,
        ReplyMarkupInterface $reply_markup = null
    ) {
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return Message::parse($data);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display them in the music player.
     * Your audio must be in the .mp3 format. On success, the sent {@see \Tigris\Types\Message} is returned.
     * Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future.
     *
     * @link https://core.telegram.org/bots/api#sendaudio
     *
     * @param integer|string $chat_id
     * @param string|resource $audio
     * @param integer|null $duration
     * @param string|null $performer
     * @param string|null $title
     * @param boolean|null $disable_notification
     * @param integer|null $reply_to_message_id
     * @param ReplyMarkupInterface|null $reply_markup
     * @return Message
     */
    public function sendAudio(
        $chat_id,
        $audio,
        $duration = null,
        $performer = null,
        $title = null,
        $disable_notification = null,
        $reply_to_message_id = null,
        ReplyMarkupInterface $reply_markup = null
    ) {
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return Message::parse($data);
    }

    /**
     * Use this method to send general files. On success, the sent {@see \Tigris\Types\Message} is returned.
     * Bots can currently send files of any type of up to 50 MB in size, this limit may be changed in the future.
     *
     * @link https://core.telegram.org/bots/api#senddocument
     *
     * @param integer|string $chat_id
     * @param string|resource $document
     * @param string|null $caption
     * @param boolean|null $disable_notification
     * @param integer|null $reply_to_message_id
     * @param ReplyMarkupInterface|null $reply_markup
     * @return Message
     */
    public function sendDocument(
        $chat_id,
        $document,
        $caption = null,
        $disable_notification = null,
        $reply_to_message_id = null,
        ReplyMarkupInterface $reply_markup = null
    ) {
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return Message::parse($data);
    }

    /**
     * Use this method to send .webp stickers.
     * On success, the sent {@see \Tigris\Types\Message} is returned.
     *
     * @link https://core.telegram.org/bots/api#sendsticker
     *
     * @param integer|string $chat_id
     * @param string|resource $sticker
     * @param boolean|null $disable_notification
     * @param integer|null $reply_to_message_id
     * @param ReplyMarkupInterface|null $reply_markup
     * @return Message
     */
    public function sendSticker(
        $chat_id,
        $sticker,
        $disable_notification = null,
        $reply_to_message_id = null,
        $reply_markup = null
    ) {
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return Message::parse($data);
    }

    /**
     * Use this method to send video files, Telegram clients support mp4 videos
     * (other formats may be sent as {@see Tigris\Types\Document}).
     * On success, the sent {@see \Tigris\Types\Message} is returned. Bots can currently send video files of up to
     * 50 MB in size, this limit may be changed in the future.
     *
     * @link https://core.telegram.org/bots/api#sendvideo
     *
     * @param integer|string $chat_id
     * @param string|resource $video
     * @param integer|null $duration
     * @param integer|null $width
     * @param integer|null $height
     * @param string|null $caption
     * @param boolean|null $disable_notification
     * @param integer|null $reply_to_message_id
     * @param ReplyMarkupInterface|null $reply_markup
     * @return Message
     */
    public function sendVideo(
        $chat_id,
        $video,
        $duration = null,
        $width = null,
        $height = null,
        $caption = null,
        $disable_notification = null,
        $reply_to_message_id = null,
        $reply_markup = null
    ) {
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return Message::parse($data);
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
     * @param integer|string $chat_id
     * @param string|resource $voice
     * @param integer|null $duration
     * @param boolean|null $disable_notification
     * @param integer|null $reply_to_message_id
     * @param ReplyMarkupInterface|null $reply_markup
     * @return Message
     */
    public function sendVoice(
        $chat_id,
        $voice,
        $duration = null,
        $disable_notification = null,
        $reply_to_message_id = null,
        $reply_markup = null
    ) {
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return Message::parse($data);
    }

    /**
     * Use this method to send point on the map.
     * On success, the sent {@see \Tigris\Types\Message} is returned.
     *
     * @link https://core.telegram.org/bots/api#sendlocation
     *
     * @param integer|string $chat_id
     * @param float $latitude
     * @param float $longitude
     * @param boolean|null $disable_notification
     * @param integer|null $reply_to_message_id
     * @param ReplyMarkupInterface|null $reply_markup
     * @return Message
     */
    public function sendLocation(
        $chat_id,
        $latitude,
        $longitude,
        $disable_notification = null,
        $reply_to_message_id = null,
        $reply_markup = null
    ) {
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return Message::parse($data);
    }

    /**
     * Use this method to send information about a venue.
     * On success, the sent {@see \Tigris\Types\Message} is returned.
     *
     * @link https://core.telegram.org/bots/api#sendvenue
     *
     * @param integer|string $chat_id
     * @param float $latitude
     * @param float $longitude
     * @param string $title
     * @param string $address
     * @param string $foursquare_id
     * @param boolean|null $disable_notification
     * @param integer|null $reply_to_message_id
     * @param ReplyMarkupInterface|null $reply_markup
     * @return Message
     */
    public function sendVenue(
        $chat_id,
        $latitude,
        $longitude,
        $title,
        $address,
        $foursquare_id,
        $disable_notification = null,
        $reply_to_message_id = null,
        $reply_markup = null
    ) {
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return Message::parse($data);
    }

    /**
     * Use this method to send phone contacts.
     * On success, the sent {@see \Tigris\Types\Message} is returned.
     *
     * @link https://core.telegram.org/bots/api#sendcontact
     *
     * @param integer|string $chat_id
     * @param string $phone_number
     * @param string $first_name
     * @param string|null $last_name
     * @param boolean|null $disable_notification
     * @param integer|null $reply_to_message_id
     * @param ReplyMarkupInterface|null $reply_markup
     * @return Message
     */
    public function sendContact(
        $chat_id,
        $phone_number,
        $first_name,
        $last_name = null,
        $disable_notification = null,
        $reply_to_message_id = null,
        $reply_markup = null
    ) {
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return Message::parse($data);
    }

    /**
     * Use this method when you need to tell the user that something is happening on the bot's side. The status
     * is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status).
     *
     * @link https://core.telegram.org/bots/api#sendchataction
     *
     * @param integer|Chat $chat_id
     * @param string $action
     * @return true
     */
    public function sendChatAction(
        $chat_id,
        $action
    ) {
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return ScalarBoolean::parse($data);
    }

    /**
     * Use this method to get a list of profile pictures for a user.
     * Returns a {@see \Tigris\Types\UserProfilePhotos} object.
     *
     * @link https://core.telegram.org/bots/api#getuserprofilephotos
     *
     * @param integer $user_id
     * @param integer $offset
     * @param integer $limit
     * @return UserProfilePhotos
     */
    public function getUserProfilePhotos(
        $user_id,
        $offset = null,
        $limit = null
    ) {
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return UserProfilePhotos::parse($data);
    }

    /**
     * Use this method to get basic info about a file and prepare it for downloading.
     * For the moment, bots can download files of up to 20MB in size.
     * On success, a File object is returned.
     *
     * @link https://core.telegram.org/bots/api#getfile
     *
     * @param integer $file_id
     * @return File
     */
    public function getFile(
        $file_id
    ) {
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return File::parse($data);
    }

    /**
     * Use this method to kick a user from a group or a supergroup. In the case of supergroups, the user will not
     * be able to return to the group on their own using invite links, etc., unless unbanned first. The bot must be
     * an administrator in the group for this to work. Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#kickchatmember
     *
     * @param integer|string $chat_id
     * @param integer $user_id
     * @return true
     */
    public function kickChatMember(
        $chat_id,
        $user_id
    ) {
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return ScalarBoolean::parse($data);
    }

    /**
     * Use this method for your bot to leave a group, supergroup or channel.
     * Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#leavechat
     *
     * @param integer|string $chat_id
     * @return true
     */
    public function leaveChat(
        $chat_id
    ) {
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return ScalarBoolean::parse($data);
    }

    /**
     * Use this method to unban a previously kicked user in a supergroup. The user will not return to the group
     * automatically, but will be able to join via link, etc. The bot must be an administrator in the group for this
     * to work. Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#unbanchatmember
     *
     * @param integer|string $chat_id
     * @param integer $user_id
     * @return true
     */
    public function unbanChatMember(
        $chat_id,
        $user_id
    ) {
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return ScalarBoolean::parse($data);
    }

    /**
     * Use this method to get up to date information about the chat (current name of the user for one-on-one
     * conversations, current username of a user, group or channel, etc.).
     * Returns a {@see \Tigris\Types\Chat} object on success.
     *
     * @link https://core.telegram.org/bots/api#getchat
     *
     * @param integer|string $chat_id
     * @return Chat
     */
    public function getChat(
        $chat_id
    ) {
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return Chat::parse($data);
    }

    /**
     * Use this method to get a list of administrators in a chat. On success, returns an Array of ChatMember objects
     * that contains information about all chat administrators except other bots. If the chat is a group or a
     * supergroup and no administrators were appointed, only the creator will be returned.
     *
     * @link https://core.telegram.org/bots/api#getchatadministrators
     *
     * @param integer|string $chat_id
     * @return ChatMember[]|ChatMemberArray
     */
    public function getChatAdministrators(
        $chat_id
    ) {
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return ChatMemberArray::parse($data);
    }

    /**
     * Use this method to get the number of members in a chat.
     * Returns Int on success.
     *
     * @link https://core.telegram.org/bots/api#getchatmemberscount
     *
     * @param integer|string $chat_id
     * @return integer
     */
    public function getChatMembersCount(
        $chat_id
    ) {
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return ScalarInteger::parse($data);
    }

    /**
     * Use this method to get information about a member of a chat.
     * Returns a {@see \Tigris\Types\ChatMember} object on success.
     *
     * @link https://core.telegram.org/bots/api#getchatmember
     *
     * @param integer|string $chat_id
     * @param integer|string $user_id
     * @return ChatMember
     */
    public function getChatMember(
        $chat_id,
        $user_id
    ) {
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return ChatMember::parse($data);
    }

    /**
     * Use this method to send answers to callback queries sent from inline keyboards.
     * The answer will be displayed to the user as a notification at the top of the chat screen or as an alert.
     * On success, True is returned.
     *
     * @link https://core.telegram.org/bots/api#answercallbackquery
     *
     * @param string $callback_query_id
     * @param string $text
     * @param boolean $show_alert
     * @param string $url
     * @return true
     */
    public function answerCallbackQuery(
        $callback_query_id,
        $text,
        $show_alert,
        $url = null
    ) {
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return ScalarBoolean::parse($data);
    }

    /**
     * Use this method to send answers to callback queries sent from inline keyboards.
     * The answer will be displayed to the user as a notification at the top of the chat screen or as an alert.
     * On success, True is returned.
     *
     * @link https://core.telegram.org/bots/api#answerinlinequery
     *
     * @param string $inline_query_id
     * @param InlineQueryResult[] $results
     * @param integer|null $cache_time
     * @param boolean|null $is_personal
     * @param string|null $next_offset
     * @param string|null $switch_pm_text
     * @param string|null $switch_pm_parameter
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
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return ScalarBoolean::parse($data);
    }

    // Games endpoints

    /**
     * Use this method to send a game.
     * On success, the sent Message is returned.
     *
     * @link https://core.telegram.org/bots/api#sendgame
     *
     * @param integer|string $chat_id
     * @param string $game_short_name
     * @param boolean|null $disable_notification
     * @param integer|null $reply_to_message_id
     * @param ReplyMarkupInterface|null $reply_markup
     * @return Message
     */
    public function sendGame(
        $chat_id,
        $game_short_name,
        $disable_notification = null,
        $reply_to_message_id = null,
        ReplyMarkupInterface $reply_markup = null
    ) {
        $data = $this->call(__FUNCTION__, $this->parseArgs(__FUNCTION__, func_get_args()));
        return Message::parse($data);
    }

    /**
     * @param $methodName
     * @param array $args
     * @return array
     */
    protected function parseArgs($methodName, array $args)
    {
        $method =  new \ReflectionMethod(static::class, $methodName);
        $result = [];
        foreach ($method->getParameters() as $i=> $p) {
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