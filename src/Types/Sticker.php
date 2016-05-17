<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;

/**
 * Class Sticker
 * This object represents a sticker.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#sticker
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

    /**
     * @inheritdoc
     */
    protected static function requiredFields()
    {
        return [
            'file_id',
            'width',
            'height',
        ];
    }
}