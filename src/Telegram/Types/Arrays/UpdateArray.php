<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types\Arrays;

use Tigris\Telegram\Types\Base\BaseArray;
use Tigris\Telegram\Types\Updates\Update;

/**
 * Class UpdateArray
 * @package Tigris\Types
 */
class UpdateArray extends BaseArray
{
    const ENTITY_CLASS = Update::class;
}