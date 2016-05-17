<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;

/**
 * Class Video
 * This object represents a video file.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#video
 */
class Video extends BaseObject
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
            'duration' => ScalarInteger::class,
            'thumb' => PhotoSize::class,
            'mime_type' => ScalarString::class,
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
            'duration',
        ];
    }
}