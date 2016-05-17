<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;

/**
 * Class ReplyKeyboardHide
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#replykeyboardhide
 *
 * @property boolean $hide_keyboard
 * @property boolean $selective
 */
class ReplyKeyboardHide extends BaseObject
{
    public static function create($selective = false)
    {
        $data = [
            'hide_keyboard' => true,
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
            'hide_keyboard' => ScalarBoolean::class,
            'selective' => ScalarBoolean::class,
        ];
    }

    /**
     * @inheritdoc
     */
    protected static function requiredFields()
    {
        return [
            'hide_keyboard',
        ];
    }
}