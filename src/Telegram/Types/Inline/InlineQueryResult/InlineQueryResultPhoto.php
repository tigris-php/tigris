<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types\Inline\InlineQueryResult;
use Tigris\Telegram\Types\Inline\InlineQueryResult;

/**
 * Represents a link to a photo. By default, this photo will be sent by the user with optional caption.
 * Alternatively, you can use input_message_content to send a message with the specified content instead of the photo.
 *
 * @package Tigris\Types\Inline
 * @link https://core.telegram.org/bots/api#inlinequeryresultphoto
 *
 * @property string $photo_url A valid URL of the photo. Photo must be in jpeg format. Photo size must not exceed 5MB.
 * @property string $thumb_url URL of the thumbnail for the photo.
 * @property string $photo_width Optional. Width of the photo.
 * @property string $photo_height Optional. Height of the photo.
 * @property string $title Optional. Title for the result.
 * @property string $description Optional. Short description of the result.
 * @property string $caption Optional. Caption of the photo to be sent, 0-200 characters.
 */
class InlineQueryResultPhoto extends InlineQueryResult
{
    const TYPE = 'photo';
}