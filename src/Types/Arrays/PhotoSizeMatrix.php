<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Arrays;

use Tigris\Types\Base\BaseMatrix;
use Tigris\Types\PhotoSize;

/**
 * Class PhotoSizeMatrix
 * @package Tigris\Types
 */
class PhotoSizeMatrix extends BaseMatrix
{
    const ENTITY_CLASS = PhotoSize::class;
}