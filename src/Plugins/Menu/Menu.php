<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Plugins\Menu;

use Tigris\Bot;
use Tigris\Helpers\ArrayHelper;
use Tigris\Types\KeyboardButton;
use Tigris\Types\ReplyKeyboardMarkup;

/**
 * Menu helper.
 *
 * @package Tigris\Plugins\Menu
 */
class Menu
{
    /**
     * @param string $id
     * @param string $title
     * @param MenuItem[] $items
     * @return MenuObject
     */
    public static function register($id, $title, $items)
    {
        return MenuObject::create($id, $title, $items);
    }

     /**
     * @param $text
     * @return MenuItem
     */
    public static function item($text)
    {
        return MenuItem::create($text);
    }
}