<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;

/**
 * Class ReplyKeyboardMarkup
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#replykeyboardmarkup
 *
 * @property Keyboard $keyboard
 * @property ScalarBoolean $resize_keyboard
 * @property ScalarBoolean $one_time_keyboard
 * @property ScalarBoolean $selective
 */
class ReplyKeyboardMarkup extends BaseObject
{
    public static function create($keyboard, $resizeKeyboard = false, $oneTimeKeyboard = false, $selective = false)
    {
        $data = [
            'keyboard' => $keyboard,
            'resize_keyboard' => $resizeKeyboard,
            'one_time_keyboard' => $oneTimeKeyboard,
            'selective' => $selective,
        ];
        return static::build($data);
    }
    
    /**
     * @inheritdoc
     */
    protected static function fields()
    {
        return [
            'keyboard' => Keyboard::class,
            'resize_keyboard' => ScalarBoolean::class,
            'one_time_keyboard' => ScalarBoolean::class,
            'selective' => ScalarBoolean::class,
        ];
    }

    /**
     * @inheritdoc
     */
    protected static function requiredFields()
    {
        return [
            'keyboard',
        ];
    }
}