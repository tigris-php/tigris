<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types\Arrays;

use Tigris\Telegram\Types\Base\BaseArray;
use Tigris\Telegram\Types\PhotoSize;

/**
 * Class PhotoSizeArray
 * @package Tigris\Types
 */
class PhotoSizeArray extends BaseArray
{
    const ENTITY_CLASS = PhotoSize::class;
}