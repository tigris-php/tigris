<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types\Inline\InputMessageContent;

use Tigris\Telegram\Types\Inline\InputMessageContent;

/**
 * Represents the content of a venue message to be sent as the result of an inline query.
 *
 * @package Tigris\Types\Inline
 * @link https://core.telegram.org/bots/api#inputvenuemessagecontent
 *
 * @property float $latitude Latitude of the location in degrees.
 * @property float $longitude Longitude of the location in degrees.
 * @property string $title Name of the venue.
 * @property string $address Address of the venue.
 * @property string $foursquare_id Optional. Foursquare identifier of the venue, if known.
 */
class InputVenueMessageContent extends InputMessageContent
{

}