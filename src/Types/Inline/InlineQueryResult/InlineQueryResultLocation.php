<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Inline\InlineQueryResult;
use Tigris\Types\Inline\InlineQueryResult;

/**
 * Represents a location on a map. By default, the location will be sent by the user.
 * Alternatively, you can use input_message_content to send a message with the specified content instead of the location.
 *
 * @package Tigris\Types\Inline
 * @link https://core.telegram.org/bots/api#inlinequeryresultlocation
 *
 * @property float $latitude Location latitude in degrees.
 * @property float $longitude Location longitude in degrees.
 * @property string $title Location title.
 * @property string $thumb_url Optional. Url of the thumbnail for the result.
 * @property integer $thumb_width Optional. Thumbnail width.
 * @property integer $thumb_height Optional. Thumbnail height.
 */
class InlineQueryResultLocation extends InlineQueryResult
{
    const TYPE = 'location';
}