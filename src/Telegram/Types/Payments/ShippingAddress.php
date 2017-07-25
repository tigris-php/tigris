<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types\Payments;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarString;

/**
 * Class ShippingAddress
 * This object represents a shipping address.
 *
 * @package Tigris\Telegram\Types
 * @link https://core.telegram.org/bots/api#shippingaddress
 *
 * @property string $country_code
 * @property string $state
 * @property string $city
 * @property string $street_line1
 * @property string $street_line2
 * @property string $post_code
 */
class ShippingAddress extends BaseObject
{
    public static function fields()
    {
        return [
            'country_code' => ScalarString::class,
            'state' => ScalarString::class,
            'city' => ScalarString::class,
            'street_line1' => ScalarString::class,
            'street_line2' => ScalarString::class,
            'post_code' => ScalarString::class,
        ];
    }
}