<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;

/**
 * Class Sticker
 * This object represents a sticker.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#sticker
 *
 * @property ScalarString $file_id
 * @property ScalarInteger $width
 * @property ScalarInteger $height
 * @property PhotoSize $thumb
 * @property ScalarString $emoji
 * @property ScalarInteger $file_size
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