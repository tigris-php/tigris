<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Inline\InlineQueryResult;
use Tigris\Types\Scalar\ScalarString;

/**
 * Represents a link to an mp3 audio file stored on the Telegram servers.
 * By default, this audio file will be sent by the user.
 * Alternatively, you can use input_message_content to send a message with the specified content instead of the audio.
 *
 * @package Tigris\Types\Inline
 * @link https://core.telegram.org/bots/api#inlinequeryresultcachedaudio
 *
 * @property string $audio_file_id A valid file identifier for the audio file.
 * @property string $caption Optional. Caption, 0-200 characters.
 */
class InlineQueryResultCachedAudio extends AbstractInlineQueryResult
{
    const TYPE = 'audio';

    protected static function extraFields()
    {
        return [
            'audio_file_id' => ScalarString::class,
            'caption' => ScalarString::class,
        ];
    }
}