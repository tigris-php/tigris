<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Arrays;

use Tigris\Types\Base\BaseArray;
use Tigris\Types\PhotoSize;

/**
 * Class PhotoSizeArray
 * @package Tigris\Types
 */
class PhotoSizeArray extends BaseArray
{
    const ENTITY_CLASS = PhotoSize::class;
}