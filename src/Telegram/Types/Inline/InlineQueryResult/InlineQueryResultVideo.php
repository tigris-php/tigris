<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types\Inline\InlineQueryResult;
use Tigris\Telegram\Types\Inline\InlineQueryResult;

/**
 * Represents a link to a page containing an embedded video player or a video file.
 * By default, this video file will be sent by the user with an optional caption.
 * Alternatively, you can use input_message_content to send a message with the specified content instead of the video.
 *
 * @package Tigris\Types\Inline
 * @link https://core.telegram.org/bots/api#inlinequeryresultvideo
 *
 * @property string $video_url A valid URL for the embedded video player or video file.
 * @property string $mime_type Mime type of the content of video url, “text/html” or “video/mp4”.
 * @property string $thumb_url URL of the thumbnail (jpeg only) for the video.
 * @property string $title Title for the result.
 * @property string $caption Optional. Caption of the video to be sent, 0-200 characters.
 * @property integer $video_width Optional. Video width.
 * @property integer $video_height Optional. Video height.
 * @property integer $video_duration Optional. Video duration in seconds.
 * @property string $description Optional. Short description of the result.
 */
class InlineQueryResultVideo extends InlineQueryResult
{
    const TYPE = 'video';
}