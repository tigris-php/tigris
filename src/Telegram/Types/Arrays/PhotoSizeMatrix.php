<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types\Arrays;

use Tigris\Telegram\Types\Base\BaseArray;
use Tigris\Telegram\Types\PhotoSize;

/**
 * Class PhotoSizeMatrix
 * @package Tigris\Types
 */
class PhotoSizeMatrix extends BaseArray
{
    const ENTITY_CLASS = PhotoSize::class;
    const DIMENSION = 2;
}