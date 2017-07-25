<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types\Payments;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarInteger;
use Tigris\Telegram\Types\Scalar\ScalarString;
use Tigris\Telegram\Types\User;

/**
 * Class PreCheckoutQuery
 * This object contains information about an incoming pre-checkout query.
 *
 * @package Tigris\Telegram\Types
 * @link https://core.telegram.org/bots/api#precheckoutquery
 *
 * @property string $id
 * @property User $from
 * @property string $currency
 * @property integer $total_amount
 * @property string $invoice_payload
 * @property string $shipping_option_id
 * @property OrderInfo $order_info
 */
class PreCheckoutQuery extends BaseObject
{
    public static function fields()
    {
        return [
            'id' => ScalarString::class,
            'from' => User::class,
            'currency' => ScalarString::class,
            'total_amount' => ScalarInteger::class,
            'invoice_payload' => ScalarString::class,
            'shipping_option_id' => ScalarString::class,
            'order_info' => OrderInfo::class,
        ];
    }
}