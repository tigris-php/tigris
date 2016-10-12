<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Inline\InlineQueryResult;
use Tigris\Types\Inline\InlineQueryResult;

/**
 * Represents a link to a photo stored on the Telegram servers.
 * By default, this photo will be sent by the user with an optional caption.
 * Alternatively, you can use input_message_content to send a message with the specified content instead of the photo.
 *
 * @package Tigris\Types\Inline
 * @link https://core.telegram.org/bots/api#inlinequeryresultcachedphoto
 *
 * @property string $photo_file_id A valid file identifier of the photo.
 * @property string $title Optional. Title for the result.
 * @property string $description Optional. Short description of the result.
 * @property string $caption Optional. Caption of the photo to be sent, 0-200 characters.
 */
class InlineQueryResultCachedPhoto extends InlineQueryResult
{
    const TYPE = 'photo';
}