<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types;

use Tigris\Telegram\Types\Base\BaseObject;

/**
 * Class KeyboardButton
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#keyboardbutton
 *
 * @property string $text
 * @property bool|null $request_contact
 * @property bool|null $request_location
 */
class KeyboardButton extends BaseObject
{
    const REQUEST_CONTACT = 'request_contact';
    const REQUEST_LOCATION = 'request_location';

    /**
     * @param $text
     * @param null $request
     * @return null|static
     */
    public static function create($text, $request = null)
    {
        if (empty($text)) {
            throw new \InvalidArgumentException('Empty button text');
        }

        switch ($request) {
            case null:
            case static::REQUEST_CONTACT:
            case static::REQUEST_LOCATION:
                break;
            default:
                throw new \InvalidArgumentException('Invalid $request value: ' . $request);
        }
        $data = compact('text');
        if ($request) {
            $data[$request] = true;
        }
        return static::build($data);
    }
}