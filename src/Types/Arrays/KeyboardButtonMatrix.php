<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Arrays;

use Tigris\Types\Base\BaseMatrix;
use Tigris\Types\KeyboardButton;

/**
 * @package Tigris\Types
 */
class KeyboardButtonMatrix extends BaseMatrix
{
    const ENTITY_CLASS = KeyboardButton::class;

    /**
     * @param KeyboardButton[][] $buttons
     * @return KeyboardButtonMatrix
     */
    public static function create($buttons)
    {
        return static::build($buttons);
    }
}