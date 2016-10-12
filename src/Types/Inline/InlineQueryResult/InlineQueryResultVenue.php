<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Inline\InlineQueryResult;

use Tigris\Types\Scalar\ScalarFloat;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;

/**
 * Represents a venue. By default, the venue will be sent by the user.
 * Alternatively, you can use input_message_content to send a message with the specified content instead of the venue.
 *
 * @package Tigris\Types\Inline
 * @link https://core.telegram.org/bots/api#inlinequeryresultvenue
 *
 * @property float $latitude Latitude of the venue location in degrees.
 * @property float $longitude Longitude of the venue location in degrees.
 * @property string $title Title of the venue.
 * @property string $address Address of the venue.
 * @property string $foursquare_id Optional. Foursquare identifier of the venue if known.
 * @property integer $thumb_url Optional. Url of the thumbnail for the result.
 * @property integer $thumb_width Optional. Thumbnail width.
 * @property integer $thumb_height Optional. Thumbnail height.
 */
class InlineQueryResultVenue extends AbstractInlineQueryResult
{
    const TYPE = 'venue';

    protected static function extraFields()
    {
        return [
            'latitude' => ScalarFloat::class,
            'longitude' => ScalarFloat::class,
            'title' => ScalarString::class,
            'address' => ScalarString::class,
            'foursquare_id' => ScalarString::class,
            'thumb_url' => ScalarString::class,
            'thumb_width' => ScalarInteger::class,
            'thumb_height' => ScalarInteger::class,
        ];
    }
}