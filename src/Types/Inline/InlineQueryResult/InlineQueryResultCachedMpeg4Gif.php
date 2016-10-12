<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Inline\InlineQueryResult;
use Tigris\Types\Inline\InlineQueryResult;

/**
 * Represents a link to a video animation (H.264/MPEG-4 AVC video without sound) stored on the Telegram servers.
 * By default, this animated MPEG-4 file will be sent by the user with an optional caption.
 * Alternatively, you can use input_message_content to send a message with the specified content instead of the animation.
 *
 * @package Tigris\Types\Inline
 * @link https://core.telegram.org/bots/api#inlinequeryresultcachedmpeg4gif
 *
 * @property string $mpeg4_file_id	A valid file identifier for the MP4 file.
 * @property string $title Optional. Title for the result.
 * @property string $caption Optional. Caption of the MPEG-4 file to be sent, 0-200 characters.
 */
class Template extends InlineQueryResult
{
    const TYPE = 'mpeg4_gif';
}