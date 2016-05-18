<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;

/**
 * Class MessageEntity
 * @package Tigris\Types
 */
class MessageEntity extends BaseObject
{
    const TYPE_MENTION = 'mention';
    const TYPE_HASH_TAG = 'hashtag';
    const TYPE_BOT_COMMAND = 'bot_command';
    const TYPE_URL = 'url';
    const TYPE_EMAIL = 'email';
    const TYPE_BOLD = 'bold';
    const TYPE_ITALIC = 'italic';
    const TYPE_CODE = 'code';
    const TYPE_PRE = 'pre';
    const TYPE_TEXT_LINK = 'text_link';

    protected static function fields()
    {
        return [
            'type' => ScalarString::class,
            'offset' => ScalarInteger::class,
            'length' => ScalarInteger::class,
            'url' => ScalarInteger::class,
        ];
    }
}