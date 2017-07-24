<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types\Arrays;

use Tigris\Telegram\Types\Base\BaseArray;
use Tigris\Telegram\Types\Payments\LabeledPrice;

/**
 * Class LabelledPriceArray
 * @package Tigris\Types
 */
class LabelledPriceArray extends BaseArray
{
    const ENTITY_CLASS = LabeledPrice::class;
}