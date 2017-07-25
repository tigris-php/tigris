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
 * This object contains information about one member of the chat.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#chatmember
 *
 * @property User $user
 * @property string $status
 * @property int|null $until_date
 * @property bool|null $can_be_edited
 * @property bool|null $can_change_info
 * @property bool|null $can_post_messages
 * @property bool|null $can_edit_messages
 * @property bool|null $can_delete_messages
 * @property bool|null $can_invite_users
 * @property bool|null $can_restrict_members
 * @property bool|null $can_pin_messages
 * @property bool|null $can_promote_members
 * @property bool|null $can_send_messages
 * @property bool|null $can_send_media_messages
 * @property bool|null $can_send_other_messages
 * @property bool|null $can_add_web_page_previews
 */
class ChatMember extends BaseObject
{
    const STATUS_CREATOR = 'creator';
    const STATUS_ADMINISTRATOR = 'administrator';
    const STATUS_MEMBER = 'member';
    const STATUS_RESTRICTED = 'restricted';
    const STATUS_LEFT = 'left';
    const STATUS_KICKED = 'kicked';

    public static function fields()
    {
        return [
            'user' => User::class,
            'status' => ScalarString::class,
            'until_date' => ScalarInteger::class,
            'can_be_edited' => ScalarBoolean::class,
            'can_change_info' => ScalarBoolean::class,
            'can_post_messages' => ScalarBoolean::class,
            'can_edit_messages' => ScalarBoolean::class,
            'can_delete_messages' => ScalarBoolean::class,
            'can_invite_users' => ScalarBoolean::class,
            'can_restrict_members' => ScalarBoolean::class,
            'can_pin_messages' => ScalarBoolean::class,
            'can_promote_members' => ScalarBoolean::class,
            'can_send_messages' => ScalarBoolean::class,
            'can_send_media_messages' => ScalarBoolean::class,
            'can_send_other_messages' => ScalarBoolean::class,
            'can_add_web_page_previews' => ScalarBoolean::class,
        ];
    }
}