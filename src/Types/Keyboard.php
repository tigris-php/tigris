<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseMatrix;

/**
 * Class Keyboard
 * @package Tigris\Types
 */
class Keyboard extends BaseMatrix
{
    const ENTITY_CLASS = KeyboardButton::class;

    /**
     * @param KeyboardButton[][] $buttons
     * @return mixed|null|static
     */
    public static function create($buttons)
    {
        return static::build($buttons);
    }
}