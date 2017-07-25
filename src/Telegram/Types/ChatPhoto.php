<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarString;

/**
 * Class ChatPhoto
 * This object represents a chat photo.
 *
 * @package Tigris\Telegram\Types
 * @link https://core.telegram.org/bots/api#chatphoto
 *
 * @property string $small_file_id
 * @property string $big_file_id
 */
class ChatPhoto extends BaseObject
{
    public static function fields()
    {
        return [
            'small_file_id' => ScalarString::class,
            'big_file_id' => ScalarString::class,
        ];
    }
}