<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;
use Tigris\Types\Interfaces\ReplyMarkupInterface;

/**
 * Class ReplyKeyboardMarkup
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#replykeyboardmarkup
 *
 * @property KeyboardButton[][] $keyboard
 * @property boolean $resize_keyboard
 * @property boolean $one_time_keyboard
 * @property boolean $selective
 */
class ReplyKeyboardMarkup extends BaseObject implements ReplyMarkupInterface
{
    /**
     * Constructor
     * 
     * @param KeyboardButton[][] $keyboard
     * @param boolean $resize_keyboard
     * @param boolean $one_time_keyboard
     * @param boolean $selective
     * @return static
     */
    public static function create(
        $keyboard,
        $resize_keyboard = false,
        $one_time_keyboard = false,
        $selective = false
    ){
        return static::build(compact(
            'keyboard',
            'resize_keyboard',
            'one_time_keyboard',
            'selective'
        ));
    }
}