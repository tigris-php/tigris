<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types\Inline\InlineQueryResult;
use Tigris\Telegram\Types\Inline\InlineQueryResult;

/**
 * Represents a link to a video file stored on the Telegram servers.
 * By default, this video file will be sent by the user with an optional caption.
 * Alternatively, you can use input_message_content to send a message with the specified content instead of the video.
 *
 * @package Tigris\Types\Inline
 * @link https://core.telegram.org/bots/api#inlinequeryresultcachedvideo
 *
 * @property string $video_file_id A valid file identifier for the video file.
 * @property string $title Title for the result.
 * @property string $description Optional. Short description of the result.
 * @property string $caption Optional. Caption of the video to be sent, 0-200 characters.
 */
class InlineQueryResultCachedVideo extends InlineQueryResult
{
    const TYPE = 'video';
}