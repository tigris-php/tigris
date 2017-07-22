<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarInteger;
use Tigris\Telegram\Types\Scalar\ScalarString;

/**
 * Class Sticker
 * This object represents a sticker.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#sticker
 *
 * @property string $file_id Unique identifier for this file.
 * @property integer $width Sticker width.
 * @property integer $height Sticker height.
 * @property PhotoSize $thumb Optional. Sticker thumbnail in .webp or .jpg format.
 * @property string $emoji Optional. Emoji associated with the sticker.
 * @property integer $file_size Optional. File size.
 */
class Sticker extends BaseObject
{
    /**
     * @inheritdoc
     */
    protected static function fields()
    {
        return [
            'file_id' => ScalarString::class,
            'width' => ScalarInteger::class,
            'height' => ScalarInteger::class,
            'thumb' => PhotoSize::class,
            'emoji' => ScalarString::class,
            'file_size' => ScalarInteger::class,
        ];
    }
}