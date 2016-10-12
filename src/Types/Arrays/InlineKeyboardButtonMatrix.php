<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Arrays;

use Tigris\Types\Base\BaseMatrix;
use Tigris\Types\InlineKeyboardButton;

/**
 * @package Tigris\Types
 */
class InlineKeyboardButtonMatrix extends BaseMatrix
{
    const ENTITY_CLASS = InlineKeyboardButton::class;

    /**
     * @param InlineKeyboardButton[][] $buttons
     * @return InlineKeyboardButtonMatrix
     */
    public static function create($buttons)
    {
        return static::build($buttons);
    }
}