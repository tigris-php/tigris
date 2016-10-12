<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Inline\InlineQueryResult;
use Tigris\Types\Inline\InlineQueryResult;

/**
 * Represents a link to an mp3 audio file. By default, this audio file will be sent by the user.
 * Alternatively, you can use input_message_content to send a message with the specified content instead of the audio.
 *
 * @package Tigris\Types\Inline
 * @link https://core.telegram.org/bots/api#inlinequeryresultaudio
 *
 * @property string $audio_url A valid URL for the audio file.
 * @property string $title Title.
 * @property string $caption Optional. Caption, 0-200 characters.
 * @property string $performer Optional. Performer.
 * @property integer $audio_duration Optional. Audio duration in seconds.
 */
class InlineQueryResultAudio extends InlineQueryResult
{
    const TYPE = 'audio';
}