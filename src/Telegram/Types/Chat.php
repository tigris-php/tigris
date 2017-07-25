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
 * @property string|null $title
 * @property string|null $username
 * @property string|null $first_name
 * @property string|null $last_name
 * @property bool|null $all_members_are_administrators
 * @property ChatPhoto|null $photo
 * @property string|null $description
 * @property string|null $invite_link
 */
class Chat extends BaseObject
{
    const TYPE_PRIVATE = 'private';
    const TYPE_GROUP = 'group';
    const TYPE_SUPERGROUP = 'supergroup';
    const TYPE_CHANNEL = 'channel';

    public static function fields()
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
}