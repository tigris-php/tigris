<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;

/**
 * Class Audio
 * This object represents an audio file to be treated as music by the Telegram clients.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#audio
 *
 * @property ScalarString $file_id
 * @property ScalarInteger $duration
 * @property ScalarString $performer
 * @property ScalarString $title
 * @property ScalarString $mime_type
 * @property ScalarInteger $file_size
 */
class Audio extends BaseObject
{
    /**
     * @inheritdoc
     */
    protected static function fields()
    {
        return [
            'file_id' => ScalarString::class,
            'duration' => ScalarInteger::class,
            'performer' => ScalarString::class,
            'title' => ScalarString::class,
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
            'duration',
        ];
    }
}