<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Tigris\Exceptions\TelegramApiException;
use Tigris\Helpers\ArrayHelper;
use Tigris\Types\Chat;
use Tigris\Types\File;
use Tigris\Types\Interfaces\TypeInterface;
use Tigris\Types\Message;
use Tigris\Types\Update;
use Tigris\Types\UpdateArray;
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
     * Use this method to receive incoming updates using long polling. An Array of Update objects is returned.
     * @link https://core.telegram.org/bots/api/#getting-updates
     *
     * @param null $offset
     * @param null $limit
     * @param null $timeout
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
     * @return User
     */
    public function getMe()
    {
        $data = $this->call('getMe');
        return User::build($data);
    }

    /**
     * @link https://core.telegram.org/bots/api#sendmessage
     *
     * @param $chatId
     * @param $text
     * @param string|null $parseMode
     * @param boolean|null $disableWebPagePreview
     * @param boolean|null $disableNotification
     * @param integer|null $replyToMessageId
     * @param mixed|null $replyMarkup
     * @return Message
     */
    public function sendMessage(
        $chatId,
        $text,
        $parseMode = null,
        $disableWebPagePreview = null,
        $disableNotification = null,
        $replyToMessageId = null,
        $replyMarkup = null
    ) {
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
     * @link https://core.telegram.org/bots/api#forwardmessage
     *
     * @param integer|string $chatId
     * @param integer|string $fromChatId
     * @param integer $messageId
     * @param bool $disableNotification
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
     * @link https://core.telegram.org/bots/api#sendphoto
     *
     * @param $chatId
     * @param $photo
     * @param $caption
     * @param boolean|null $disableNotification
     * @param integer|null $replyToMessageId
     * @param mixed|null $replyMarkup
     * @return Message
     */
    public function sendPhoto(
        $chatId,
        $photo,
        $caption,
        $disableNotification = null,
        $replyToMessageId = null,
        $replyMarkup = null
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

    public function sendAudio(
        $chatId,
        $audio,
        $duration = null,
        $performer = null,
        $title = null,
        $disableNotification = null,
        $replyToMessageId = null,
        $replyMarkup = null
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

    public function sendDocument(
        $chatId,
        $document,
        $caption = null,
        $disableNotification = null,
        $replyToMessageId = null,
        $replyMarkup = null
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

    public function sendContact(
        $chatId,
        $phoneNumber,
        $firstName,
        $lastName,
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
     * @link https://core.telegram.org/bots/api#kickchatmember
     *
     * @param integer|string $chatId
     * @param integer $userId
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
        return (bool) $this->call('unbanChatMember', $params);
    }

    /**
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
                $item = ArrayHelper::jsonEncode($item, false);
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