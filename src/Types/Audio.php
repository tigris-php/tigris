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
 * @property string $file_id Unique identifier for this file.
 * @property integer $duration Duration of the audio in seconds as defined by sender.
 * @property string $performer Optional. Performer of the audio as defined by sender or by audio tags.
 * @property string $title Optional. Title of the audio as defined by sender or by audio tags.
 * @property string $mime_type Optional. MIME type of the file as defined by sender.
 * @property integer $file_size Optional. File size.
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
}