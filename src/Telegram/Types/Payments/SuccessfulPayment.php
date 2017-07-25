<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types\Payments;

use Tigris\Telegram\Types\Arrays\LabelledPriceArray;
use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarInteger;
use Tigris\Telegram\Types\Scalar\ScalarString;

/**
 * Class SuccessfulPayment
 * This object contains basic information about a successful payment.
 *
 * @package Tigris\Telegram\Types
 * @link https://core.telegram.org/bots/api#successfulpayment
 *
 * @property string $currency
 * @property integer $total_amount
 * @property string $invoice_payload
 * @property string $shipping_option_id
 * @property OrderInfo $order_info
 * @property string $telegram_payment_charge_id
 * @property string $provider_payment_charge_id
 */
class SuccessfulPayment extends BaseObject
{
    public static function fields()
    {
        return [
            'currency' => ScalarString::class,
            'total_amount' => ScalarInteger::class,
            'invoice_payload' => ScalarString::class,
            'shipping_option_id' => ScalarString::class,
            'order_info' => OrderInfo::class,
            'telegram_payment_charge_id' => ScalarString::class,
            'provider_payment_charge_id' => ScalarString::class,
        ];
    }
}