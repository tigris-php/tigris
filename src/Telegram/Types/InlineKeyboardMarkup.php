<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Interfaces\ReplyMarkupInterface;

/**
 * This object represents an inline keyboard that appears right next to the message it belongs to.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#inlinekeyboardmarkup
 *
 * @property InlineKeyboardButton[][] $inline_keyboard Array of button rows, each represented by an array of
 *  InlineKeyboardButton objects.
 */
class InlineKeyboardMarkup extends BaseObject implements ReplyMarkupInterface
{
    /**
     * Constructor
     * 
     * @param InlineKeyboardButton[][] $inline_keyboard
     * @return static
     */
    public static function create($inline_keyboard)
    {
        return static::build(compact('inline_keyboard'));
    }
}