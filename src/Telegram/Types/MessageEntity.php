<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarInteger;
use Tigris\Telegram\Types\Scalar\ScalarString;

/**
 * Class MessageEntity
 * This object represents one special entity in a text message. For example, hashtags, usernames, URLs, etc.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#messageentity
 *
 * @property string $type
 * @property integer $offset
 * @property integer $length
 * @property integer $url
 * @property User $user
 */
class MessageEntity extends BaseObject
{
    const TYPE_MENTION = 'mention';
    const TYPE_HASHTAG = 'hashtag';
    const TYPE_BOT_COMMAND = 'bot_command';
    const TYPE_URL = 'url';
    const TYPE_EMAIL = 'email';
    const TYPE_BOLD = 'bold';
    const TYPE_ITALIC = 'italic';
    const TYPE_CODE = 'code';
    const TYPE_PRE = 'pre';
    const TYPE_TEXT_LINK = 'text_link';
    const TYPE_TEXT_MENTION = 'text_mention';

    public static function fields()
    {
        return [
            'type' => ScalarString::class,
            'offset' => ScalarInteger::class,
            'length' => ScalarInteger::class,
            'url' => ScalarString::class,
            'user' => User::class,
        ];
    }
}