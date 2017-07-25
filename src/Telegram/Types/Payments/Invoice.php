<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types\Payments;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarString;

/**
 * Class Invoice
 * This object contains basic information about an invoice.
 *
 * @package Tigris\Telegram\Types
 * @link https://core.telegram.org/bots/api#invoice
 *
 * @property string $title
 * @property string $description
 * @property string $start_parameter
 * @property string $currency
 * @property string $integer
 */
class Invoice extends BaseObject
{
    public static function fields()
    {
        return [
            'title' => ScalarString::class,
            'description' => ScalarString::class,
            'start_parameter' => ScalarString::class,
            'currency' => ScalarString::class,
            'integer' => ScalarString::class,
        ];
    }
}