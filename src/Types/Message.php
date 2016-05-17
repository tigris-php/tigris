<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Exceptions\TelegramApiException;
use Tigris\Types\Base\BaseObject;

/**
 * Class Message
 * This object represents a message.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#message
 *
 * @property integer $message_id
 * @property User $from
 * @property integer $date
 * @property Chat $chat
 * @property User $forward_from
 * @property Chat $forward_from_chat
 * @property integer $forward_date
 * @property Message $reply_to_message
 * @property string $text
 * @property MessageEntity[] $entities
 * @property Audio $audio
 * @property Document $document
 * @property PhotoSize[] $photos
 * @property Sticker $sticker
 * @property Video $voice
 * @property string $caption
 * @property Contact $contact
 * @property Location $location
 * @property Venue $venue
 * @property User $new_chat_member
 * @property User $left_chat_member
 * @property string $new_chat_title
 * @property PhotoSize[] $new_chat_photo
 * @property boolean $delete_chat_photo
 * @property boolean $group_chat_created
 * @property boolean $supergroup_chat_created
 * @property boolean $channel_chat_created
 * @property integer $migrate_to_chat_id
 * @property integer $migrate_from_chat_id
 * @property Message $pinned_message
 */
class Message extends BaseObject
{
    // default type
    const TYPE_UNKNOWN = 'unknown';
    // standalone messages
    const TYPE_TEXT = 'text';
    const TYPE_AUDIO = 'audio';
    const TYPE_DOCUMENT = 'document';
    const TYPE_PHOTO = 'photo';
    const TYPE_STICKER = 'sticker';
    const TYPE_VIDEO = 'video';
    const TYPE_VOICE = 'voice';
    const TYPE_CONTACT = 'contact';
    const TYPE_LOCATION = 'location';
    const TYPE_VENUE = 'venue';
    // service messages
    const TYPE_NEW_CHAT_MEMBER = 'new_chat_member';
    const TYPE_LEFT_CHAT_MEMBER = 'left_chat_member';
    const TYPE_NEW_CHAT_TITLE = 'new_chat_title';
    const TYPE_NEW_CHAT_PHOTO = 'new_chat_photo';
    const TYPE_DELETE_CHAT_PHOTO = 'delete_chat_photo';
    const TYPE_GROUP_CHAT_CREATED = 'group_chat_created';
    const TYPE_SUPERGROUP_CHAT_CREATED = 'supergroup_chat_created';
    const TYPE_CHANNEL_CHAT_CREATED = 'channel_chat_created';
    const TYPE_MESSAGE_PINNED = 'pinned_message';

    public $type;

    /**
     * @inheritdoc
     */
    public static function build($data)
    {
        /** @var static $obj */
        $obj = parent::build($data);
        if (!$obj) {
            return $obj;
        }
        $obj->type = self::detectType($data);
        return $obj;
    }

    protected static function fields()
    {
        return [
            'message_id' => ScalarInteger::class,
            'from' => User::class,
            'date' => ScalarInteger::class,
            'chat' => Chat::class,
            'forward_from' => User::class,
            'forward_from_chat' => Chat::class,
            'forward_date' => ScalarInteger::class,
            'reply_to_message' => Message::class,
            'text' => ScalarString::class,
            'entities' => MessageEntityArray::class,
            'audio' => Audio::class,
            'document' => Document::class,
            'photo' => PhotoSizeArray::class,
            'sticker' => Sticker::class,
            'video' => Video::class,
            'voice' => Voice::class,
            'caption' => ScalarString::class,
            'contact' => Contact::class,
            'location' => Location::class,
            'venue' => Venue::class,
            'new_chat_member' => User::class,
            'left_chat_member' => User::class,
            'new_chat_title' => ScalarString::class,
            'new_chat_photo' => PhotoSizeArray::class,
            'delete_chat_photo' => ScalarBoolean::class,
            'group_chat_created' => ScalarBoolean::class,
            'supergroup_chat_created' => ScalarBoolean::class,
            'channel_chat_created' => ScalarBoolean::class,
            'migrate_to_chat_id' => ScalarInteger::class,
            'migrate_from_chat_id' => ScalarInteger::class,
            'pinned_message' => Message::class,
        ];
    }

    /**
     * @return array
     */
    protected static function requiredFields()
    {
        return [
            'message_id',
            'date',
            'chat',
        ];
    }

    /**
     * Detects message type
     *
     * @param $data
     * @return string
     * @throws TelegramApiException
     */
    protected static function detectType(array $data)
    {
        foreach([
            self::TYPE_TEXT,
            self::TYPE_AUDIO,
            self::TYPE_DOCUMENT,
            self::TYPE_PHOTO,
            self::TYPE_STICKER,
            self::TYPE_VIDEO,
            self::TYPE_VOICE,
            self::TYPE_CONTACT,
            self::TYPE_LOCATION,
            self::TYPE_VENUE,
            self::TYPE_NEW_CHAT_MEMBER,
            self::TYPE_LEFT_CHAT_MEMBER,
            self::TYPE_NEW_CHAT_TITLE,
            self::TYPE_NEW_CHAT_PHOTO,
            self::TYPE_DELETE_CHAT_PHOTO,
            self::TYPE_GROUP_CHAT_CREATED,
            self::TYPE_SUPERGROUP_CHAT_CREATED,
            self::TYPE_CHANNEL_CHAT_CREATED,
            self::TYPE_MESSAGE_PINNED,
        ] as $type) {
            if (isset($data[$type])) {
                return $type;
            }
        }
        return static::TYPE_UNKNOWN;
    }
}