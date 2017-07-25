<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarString;

/**
 * This object contains information about one member of the chat.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#chatmember
 *
 * @property User $user
 * @property string $status
 */
class ChatMember extends BaseObject
{
    const STATUS_CREATOR = 'creator';
    const STATUS_ADMINISTRATOR = 'administrator';
    const STATUS_MEMBER = 'member';
    const STATUS_LEFT = 'left';
    const STATUS_KICKED = 'kicked';

    public static function fields()
    {
        return [
            'user' => User::class,
            'status' => ScalarString::class,
        ];
    }
}