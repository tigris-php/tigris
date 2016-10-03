<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;
use Tigris\Types\Scalar\ScalarBoolean;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;

/**
 * Class Chat
 * This object represents a chat.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#chat
 *
 * @property integer $id Unique identifier for this chat.
 * @property string $type Type of chat.
 * @property string $title Optional. Title, for supergroups, channels and group chats.
 * @property string $username Optional. Username, for private chats, supergroups and channels if available.
 * @property string $first_name Optional. First name of the other party in a private chat.
 * @property string $last_name Optional. Last name of the other party in a private chat.
 * @property boolean $all_members_are_administrators Optional. True if a group has ‘All Members Are Admins’ enabled.
 */
class Chat extends BaseObject
{
    const TYPE_PRIVATE = 'private';
    const TYPE_GROUP = 'group';
    const TYPE_SUPERGROUP = 'supergroup';
    const TYPE_CHANNEL = 'channel';

    /**
     * @inheritdoc
     */
    protected static function fields()
    {
        return [
            'id' => ScalarInteger::class,
            'type' => ScalarString::class,
            'title' => ScalarString::class,
            'username' => ScalarString::class,
            'first_name' => ScalarString::class,
            'last_name' => ScalarString::class,
            'all_members_are_administrators' => ScalarBoolean::class,
        ];
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return (string) $this->offsetGet('id');
    }
}