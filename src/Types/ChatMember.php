<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;
use Tigris\Types\Scalar\ScalarString;

/**
 * This object contains information about one member of the chat.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#chatmember
 *
 * @property User $user Information about the user.
 * @property string $status The member's status in the chat.
 */
class ChatMember extends BaseObject
{
    const STATUS_CREATOR = 'creator';
    const STATUS_ADMINISTRATOR = 'administrator';
    const STATUS_MEMBER = 'member';
    const STATUS_LEFT = 'left';
    const STATUS_KICKED = 'kicked';

    /**
     * @inheritdoc
     */
    protected static function fields()
    {
        return [
            'user' => User::class,
            'status' => ScalarString::class,
        ];
    }
}