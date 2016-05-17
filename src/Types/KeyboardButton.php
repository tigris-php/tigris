<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;

/**
 * Class KeyboardButton
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#keyboardbutton
 *
 * @property ScalarString $text
 * @property ScalarBoolean $request_contact
 * @property ScalarBoolean $request_location
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
        switch ($request) {
            case null:
            case static::REQUEST_CONTACT:
            case static::REQUEST_LOCATION:
                break;
            default:
                throw new \InvalidArgumentException('Invalid $request value: ' . $request);
        }
        $data = [
            'text' => $text,
        ];
        if ($request) {
            $data[$request] = true;
        }
        return static::build($data);
    }
    
    /**
     * @inheritdoc
     */
    protected static function fields()
    {
        return [
            'text' => ScalarString::class,
            'request_contact' => ScalarBoolean::class,
            'request_location' => ScalarBoolean::class,
        ];
    }

    /**
     * @inheritdoc
     */
    protected static function requiredFields()
    {
        return [
            'text',
        ];
    }
}