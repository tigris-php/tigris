<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Arrays\InlineKeyboardButtonMatrix;
use Tigris\Types\Arrays\KeyboardButtonMatrix;
use Tigris\Types\Base\BaseObject;
use Tigris\Types\Interfaces\ReplyMarkupInterface;

/**
 * This object represents an inline keyboard that appears right next to the message it belongs to.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#inlinekeyboardmarkup
 *
 * @property InlineKeyboardButtonMatrix $inline_keyboard Array of button rows, each represented by an array of
 *  InlineKeyboardButton objects.
 */
class InlineKeyboardMarkup extends BaseObject implements ReplyMarkupInterface
{
    /**
     * Constructor
     * 
     * @param KeyboardButtonMatrix $inlineKeyboard
     * @return static
     */
    public static function create($inlineKeyboard)
    {
        $data = [
            'inline_keyboard' => $inlineKeyboard,
        ];
        return static::build($data);
    }
    
    /**
     * @inheritdoc
     */
    protected static function fields()
    {
        return [
            'inline_keyboard' => InlineKeyboardButtonMatrix::class,
        ];
    }
}