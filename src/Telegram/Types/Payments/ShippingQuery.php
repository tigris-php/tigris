<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types\Payments;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarString;
use Tigris\Telegram\Types\User;

/**
 * Class ShippingQuery
 * This object contains information about an incoming shipping query.
 *
 * @package Tigris\Telegram\Types
 * @link https://core.telegram.org/bots/api#shippingquery
 *
 * @property string $id
 * @property User $from
 * @property string $invoice_payload
 * @property ShippingAddress $shipping_address
 */
class ShippingQuery extends BaseObject
{
    public static function fields()
    {
        return [
            'id' => ScalarString::class,
            'from' => User::class,
            'invoice_payload' => ScalarString::class,
            'shipping_address' => ShippingAddress::class,
        ];
    }
}