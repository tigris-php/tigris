<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarBoolean;
use Tigris\Telegram\Types\Scalar\ScalarInteger;
use Tigris\Telegram\Types\Scalar\ScalarString;

/**
 * Class Chat
 * This object represents a chat.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#chat
 *
 * @property integer $id
 * @property string $type
 * @property string $title
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property boolean $all_members_are_administrators
 * @property ChatPhoto $photo
 * @property string $description
 * @property string $invite_link
 */
class Chat extends BaseObject
{
    const TYPE_PRIVATE = 'private';
    const TYPE_GROUP = 'group';
    const TYPE_SUPERGROUP = 'supergroup';
    const TYPE_CHANNEL = 'channel';

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
            'photo' => ChatPhoto::class,
            'description' => ScalarString::class,
            'invite_link' => ScalarString::class,
        ];
    }

    public function __toString()
    {
        return (string)$this->offsetGet('id');
    }
}