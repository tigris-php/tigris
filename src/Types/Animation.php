<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Arrays\PhotoSizeArray;
use Tigris\Types\Base\BaseObject;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;

/**
 * Class Animation
 * You can provide an animation for your game so that it looks stylish in chats (check out Lumberjack for an example).
 * This object represents an animation file to be displayed in the message containing a game.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#animation
 *
 * @property string $file_id Unique file identifier
 * @property PhotoSizeArray $thumb Optional. Animation thumbnail as defined by sender.
 * @property string $file_name Optional. Original animation filename as defined by sender.
 * @property string $mime_type Optional. MIME type of the file as defined by sender.
 * @property string $file_size Optional. File size.
 */
class Animation extends BaseObject
{
    /**
     * @inheritdoc
     */
    protected static function fields()
    {
        return [
            'file_id' => ScalarString::class,
            'thumb' => PhotoSizeArray::class,
            'file_name' => ScalarString::class,
            'mime_type' => ScalarString::class,
            'file_size' => ScalarInteger::class,
        ];
    }
}