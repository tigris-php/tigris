<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types\Arrays;

use Tigris\Telegram\Types\Base\BaseArray;
use Tigris\Telegram\Types\Scalar\ScalarString;

/**
 * Class ScalarStringArray
 * @package Tigris\Telegram\Types
 */
class ScalarStringArray extends BaseArray
{
    const ENTITY_CLASS = ScalarString::class;
}