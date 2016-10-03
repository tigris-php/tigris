<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;

/**
 * Class Video
 * This object represents a video file.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#video
 *
 * @property string $file_id Unique identifier for this file.
 * @property integer $width Video width as defined by sender.
 * @property integer $height Video height as defined by sender.
 * @property integer $duration Duration of the video in seconds as defined by sender.
 * @property PhotoSize $thumb Optional. Video thumbnail.
 * @property string $mime_type Optional. Mime type of a file as defined by sender.
 * @property integer $file_size Optional. File size.
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
}