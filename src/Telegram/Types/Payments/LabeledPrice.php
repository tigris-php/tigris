<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types\Payments;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarInteger;
use Tigris\Telegram\Types\Scalar\ScalarString;

/**
 * Class LabeledPrice
 * This object represents a portion of the price for goods or services.
 *
 * @package Tigris\Telegram\Types
 * @link https://core.telegram.org/bots/api#labeledprice
 *
 * @property string $label
 * @property integer $amount
 */
class LabeledPrice extends BaseObject
{
    protected static function fields()
    {
        return [
            'label' => ScalarString::class,
            'amount' => ScalarInteger::class,
        ];
    }
}