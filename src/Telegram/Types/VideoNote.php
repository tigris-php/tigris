<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarInteger;
use Tigris\Telegram\Types\Scalar\ScalarString;

/**
 * Class VideoNote
 * This object represents a video message (available in Telegram apps as of v.4.0).
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#videonote
 *
 * @property string $file_id
 * @property int $length
 * @property int $duration
 * @property PhotoSize|null $thumb
 * @property int|null $file_size
 */
class VideoNote extends BaseObject
{
    /**
     * @inheritdoc
     */
    public static function fields()
    {
        return [
            'file_id' => ScalarString::class,
            'length' => ScalarInteger::class,
            'duration' => ScalarInteger::class,
            'thumb' => PhotoSize::class,
            'file_size' => ScalarInteger::class,
        ];
    }
}