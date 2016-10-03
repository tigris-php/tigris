<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;

/**
 * Class Voice
 * This object represents a voice note.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#voice
 *
 * @property string $file_id Unique identifier for this file.
 * @property integer $duration Duration of the audio in seconds as defined by sender.
 * @property string $mime_type Optional. MIME type of the file as defined by sender.
 * @property integer $file_size Optional. File size.
 */
class Voice extends BaseObject
{
    /**
     * @inheritdoc
     */
    protected static function fields()
    {
        return [
            'file_id' => ScalarString::class,
            'duration' => ScalarInteger::class,
            'mime_type' => ScalarString::class,
            'file_size' => ScalarInteger::class,
        ];
    }
}