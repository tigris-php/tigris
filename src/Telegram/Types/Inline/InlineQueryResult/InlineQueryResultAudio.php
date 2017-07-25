<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types\Inline\InlineQueryResult;
use Tigris\Telegram\Types\Inline\InlineQueryResult;

/**
 * Represents a link to an mp3 audio file. By default, this audio file will be sent by the user.
 * Alternatively, you can use input_message_content to send a message with the specified content instead of the audio.
 *
 * @package Tigris\Types\Inline
 * @link https://core.telegram.org/bots/api#inlinequeryresultaudio
 *
 * @property string $audio_url
 * @property string $title
 * @property string|null $caption
 * @property string|null $performer
 * @property int|null $audio_duration
 */
class InlineQueryResultAudio extends InlineQueryResult
{
    const TYPE = 'audio';
}