<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;

/**
 * Class Document
 * This object represents a general file (as opposed to photos, voice messages and audio files).
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#document
 *
 * @property ScalarString $file_id
 * @property PhotoSize $thumb
 * @property ScalarString $file_name
 * @property ScalarString $mime_type
 * @property ScalarInteger $file_size
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

    /**
     * @inheritdoc
     */
    protected static function requiredFields()
    {
        return [
            'file_id',
        ];
    }
}