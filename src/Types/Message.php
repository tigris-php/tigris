<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Exceptions\TelegramApiException;
use Tigris\Types\Arrays\MessageEntityArray;
use Tigris\Types\Arrays\PhotoSizeArray;
use Tigris\Types\Base\BaseObject;
use Tigris\Types\Scalar\ScalarBoolean;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;

/**
 * Class Message
 * This object represents a message.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#message
 *
 * @property integer $message_id Unique message identifier
 * @property User $from Optional. Sender, can be empty for messages sent to channels.
 * @property integer $date Date the message was sent in Unix time.
 * @property Chat $chat Conversation the message belongs to.
 * @property User $forward_from Optional. For forwarded messages, sender of the original message.
 * @property Chat $forward_from_chat Optional. For messages forwarded from a channel, information about
 *  the original channel.
 * @property integer $forward_date Optional. For forwarded messages, date the original message was sent in Unix time.
 * @property Message $reply_to_message Optional. For replies, the original message.
 *  Note that the Message object in this field will not contain further reply_to_message fields even if it
 *  itself is a reply.
 * @property integer $edit_date Optional. Date the message was last edited in Unix time.
 * @property string $text Optional. For text messages, the actual UTF-8 text of the message, 0-4096 characters.
 * @property MessageEntity[] $entities Optional. For text messages, special entities like usernames, URLs,
 *  bot commands, etc. that appear in the text.
 * @property Audio $audio Optional. Message is an audio file, information about the file.
 * @property Document $document Optional. Message is a general file, information about the file.
 * @property Game $game Optional. Message is a game, information about the game.
 * @property PhotoSize[] $photos Optional. Message is a photo, available sizes of the photo.
 * @property Sticker $sticker Optional. Message is a sticker, information about the sticker.
 * @property Video $video Optional. Message is a video, information about the video.
 * @property Voice $voice Optional. Message is a voice message, information about the file.
 * @property string $caption Optional. Caption for the document, photo or video, 0-200 characters.
 * @property Contact $contact Optional. Message is a shared contact, information about the contact.
 * @property Location $location Optional. Message is a shared location, information about the location.
 * @property Venue $venue Optional. Message is a venue, information about the venue.
 * @property User $new_chat_member Optional. A new member was added to the group, information about them
 *  (this member may be the bot itself).
 * @property User $left_chat_member Optional. A member was removed from the group, information about them
 *  (this member may be the bot itself).
 * @property string $new_chat_title Optional. A chat title was changed to this value.
 * @property PhotoSize[] $new_chat_photo Optional. A chat photo was change to this value.
 * @property boolean $delete_chat_photo Optional. Service message: the chat photo was deleted.
 * @property boolean $group_chat_created Optional. Service message: the group has been created.
 * @property boolean $supergroup_chat_created Optional. Service message: the supergroup has been created.
 *  This field can‘t be received in a message coming through updates, because bot can’t be a member of a supergroup
 *  when it is created. It can only be found in reply_to_message if someone replies to a very first message
 *  in a directly created supergroup.
 * @property boolean $channel_chat_created Optional. Service message: the channel has been created.
 *  This field can‘t be received in a message coming through updates, because bot can’t be a member of a channel
 *  when it is created. It can only be found in reply_to_message if someone replies to a very first message
 *  in a channel.
 * @property integer $migrate_to_chat_id Optional. The group has been migrated to a supergroup with the specified
 *  identifier. This number may be greater than 32 bits and some programming languages may have difficulty/silent
 *  defects in interpreting it. But it smaller than 52 bits, so a signed 64 bit integer or double-precision float
 *  type are safe for storing this identifier.
 * @property integer $migrate_from_chat_id Optional. The supergroup has been migrated from a group with the
 *  specified identifier. This number may be greater than 32 bits and some programming languages may have
 *  difficulty/silent defects in interpreting it. But it smaller than 52 bits, so a signed 64 bit integer or
 *  double-precision float type are safe for storing this identifier.
 * @property Message $pinned_message Optional. Specified message was pinned. Note that the Message object in
 *  this field will not contain further reply_to_message fields even if it is itself a reply.
 */
class Message extends BaseObject
{
    // default type
    const TYPE_UNKNOWN = 'unknown';
    // standalone messages
    const TYPE_TEXT = 'text';
    const TYPE_AUDIO = 'audio';
    const TYPE_DOCUMENT = 'document';
    const TYPE_GAME = 'game';
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
    public static function parse($data)
    {
        /** @var static $obj */
        $obj = parent::parse($data);
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
            'edit_date' => ScalarInteger::class,
            'text' => ScalarString::class,
            'entities' => MessageEntityArray::class,
            'audio' => Audio::class,
            'document' => Document::class,
            'game' => Game::class,
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
            self::TYPE_GAME,
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

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return (string) $this->offsetGet('message_id');
    }
}