<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types\Payments;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarString;

/**
 * Class OrderInfo
 * This object represents information about an order.
 *
 * @package Tigris\Telegram\Types
 * @link https://core.telegram.org/bots/api#orderinfo
 *
 * @property string $name
 * @property string $phone_number
 * @property string $email
 * @property ShippingAddress $shipping_address
 */
class OrderInfo extends BaseObject
{
    public static function fields()
    {
        return [
            'name' => ScalarString::class,
            'phone_number' => ScalarString::class,
            'email' => ScalarString::class,
            'shipping_address' => ShippingAddress::class,
        ];
    }
}