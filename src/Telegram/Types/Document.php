<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarInteger;
use Tigris\Telegram\Types\Scalar\ScalarString;

/**
 * Class Document
 * This object represents a general file (as opposed to photos, voice messages and audio files).
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#document
 *
 * @property string $file_id Unique file identifier.
 * @property PhotoSize $thumb Optional. Document thumbnail as defined by sender.
 * @property string $file_name Optional. Original filename as defined by sender.
 * @property string $mime_type Optional. MIME type of the file as defined by sender.
 * @property integer $file_size Optional. File size.
 */
class Document extends BaseObject
{
    /**
     * @inheritdoc
     */
    protected static function fields()
    {
        return [
            'file_id' => ScalarString::class,
            'thumb' => PhotoSize::class,
            'file_name' => ScalarString::class,
            'mime_type' => ScalarString::class,
            'file_size' => ScalarInteger::class,
        ];
    }
}