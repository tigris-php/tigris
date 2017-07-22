<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarInteger;
use Tigris\Telegram\Types\Scalar\ScalarString;

/**
 * Class PhotoSize
 * This object represents one size of a photo or a file / sticker thumbnail.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#photosize
 *
 * @property string $file_id Unique identifier for this file.
 * @property integer $width Photo width.
 * @property integer $height Photo height.
 * @property integer $file_size Optional. File size.
 */
class PhotoSize extends BaseObject
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
            'file_size' => ScalarInteger::class,
        ];
    }
}