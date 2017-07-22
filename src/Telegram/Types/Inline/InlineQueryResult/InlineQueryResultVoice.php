<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types\Inline\InlineQueryResult;
use Tigris\Telegram\Types\Inline\InlineQueryResult;

/**
 * Represents a link to a voice recording in an .ogg container encoded with OPUS.
 * By default, this voice recording will be sent by the user.
 * Alternatively, you can use input_message_content to send a message with the specified content instead of the the
 * voice message.
 *
 * @package Tigris\Types\Inline
 * @link https://core.telegram.org/bots/api#inlinequeryresultvoice
 *
 * @property string $voice_url A valid URL for the voice recording.
 * @property string $title Recording title.
 * @property string $caption Optional. Caption, 0-200 characters.
 * @property integer $voice_duration Optional. Recording duration in seconds.
 */
class InlineQueryResultVoice extends InlineQueryResult
{
    const TYPE = 'voice';
}