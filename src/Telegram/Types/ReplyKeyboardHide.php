<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Interfaces\ReplyMarkupInterface;

/**
 * Class ReplyKeyboardHide
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#replykeyboardhide
 *
 * @property boolean $hide_keyboard
 * @property boolean $selective
 */
class ReplyKeyboardHide extends BaseObject implements ReplyMarkupInterface
{
    /**
     * Constructor
     *
     * @param bool $selective
     * @return static
     */
    public static function create($selective = false)
    {
        $data = compact('selective');
        $data['hide_keyboard'] = true;
        return static::build($data);
    }
}