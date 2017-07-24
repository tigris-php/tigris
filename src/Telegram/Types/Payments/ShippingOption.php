<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types\Payments;

use Tigris\Telegram\Types\Arrays\LabelledPriceArray;
use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarString;

/**
 * Class ShippingOption
 * This object represents one shipping option.
 *
 * @package Tigris\Telegram\Types
 * @link https://core.telegram.org/bots/api#shippingoption
 *
 * @property string $id
 * @property string $title
 * @property LabeledPrice[] $prices
 */
class ShippingOption extends BaseObject
{
    protected static function fields()
    {
        return [
            'id' => ScalarString::class,
            'title' => ScalarString::class,
            'prices' => LabelledPriceArray::class,
        ];
    }
}