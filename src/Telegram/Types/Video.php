<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarInteger;
use Tigris\Telegram\Types\Scalar\ScalarString;

/**
 * Class Video
 * This object represents a video file.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#video
 *
 * @property string $file_id
 * @property int $width
 * @property int $height
 * @property int $duration
 * @property PhotoSize|null $thumb
 * @property string|null $mime_type
 * @property int|null $file_size
 */
class Video extends BaseObject
{
    public static function fields()
    {
        return [
            'file_id' => ScalarString::class,
            'width' => ScalarInteger::class,
            'height' => ScalarInteger::class,
            'duration' => ScalarInteger::class,
            'thumb' => PhotoSize::class,
            'mime_type' => ScalarString::class,
            'file_size' => ScalarInteger::class,
        ];
    }
}