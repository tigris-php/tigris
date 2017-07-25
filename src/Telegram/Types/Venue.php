<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarString;

/**
 * Class Venue
 * This object represents a venue.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#venue
 *
 * @property Location $location
 * @property string $title
 * @property string $address
 * @property string|null $foursquare_id
 */
class Venue extends BaseObject
{
    public static function fields()
    {
        return [
            'location' => Location::class,
            'title' => ScalarString::class,
            'address' => ScalarString::class,
            'foursquare_id' => ScalarString::class,
        ];
    }
}