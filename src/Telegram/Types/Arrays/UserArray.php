<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types\Arrays;

use Tigris\Telegram\Types\Base\BaseArray;
use Tigris\Telegram\Types\User;

/**
 * Class UserArray
 * @package Tigris\Types
 */
class UserArray extends BaseArray
{
    const ENTITY_CLASS = User::class;
}