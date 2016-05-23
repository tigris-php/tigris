<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;

/**
 * Class PhotoSize
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#photosize
 *
 * @property ScalarString $file_id
 * @property ScalarInteger $width
 * @property ScalarInteger $height
 * @property ScalarInteger $file_size
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