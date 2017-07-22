<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types\Inline\InlineQueryResult;
use Tigris\Telegram\Types\Inline\InlineQueryResult;

/**
 * Represents a link to a video animation (H.264/MPEG-4 AVC video without sound).
 * By default, this animated MPEG-4 file will be sent by the user with optional caption.
 * Alternatively, you can use input_message_content to send a message with the specified content instead of the animation.
 *
 * @package Tigris\Types\Inline
 * @link https://core.telegram.org/bots/api#inlinequeryresultmpeg4gif
 *
 * @property string $mpeg4_url A valid URL for the MP4 file. File size must not exceed 1MB.
 * @property integer $mpeg4_width Optional. Video width.
 * @property integer $mpeg4_height Optional. Video height.
 * @property string $thumb_url URL of the static thumbnail (jpeg or gif) for the result.
 * @property string $title Optional. Title for the result.
 * @property string $caption Optional. Caption of the MPEG-4 file to be sent, 0-200 characters.
 */
class InlineQueryResultMpeg4Gif extends InlineQueryResult
{
    const TYPE = 'mpeg4_gif';
}