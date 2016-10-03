<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Arrays;

use Tigris\Types\Base\BaseArray;
use Tigris\Types\Update;

/**
 * Class UpdateArray
 * @package Tigris\Types
 */
class UpdateArray extends BaseArray
{
    const ENTITY_CLASS = Update::class;
}