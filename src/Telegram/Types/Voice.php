<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarInteger;
use Tigris\Telegram\Types\Scalar\ScalarString;

/**
 * Class Voice
 * This object represents a voice note.
 *
 * @package Tigris\Telegram\Types
 * @link https://core.telegram.org/bots/api#voice
 *
 * @property string $file_id
 * @property int $duration
 * @property string|null $mime_type
 * @property int|null $file_size
 */
class Voice extends BaseObject
{
    public static function fields()
    {
        return [
            'file_id' => ScalarString::class,
            'duration' => ScalarInteger::class,
            'mime_type' => ScalarString::class,
            'file_size' => ScalarInteger::class,
        ];
    }
}