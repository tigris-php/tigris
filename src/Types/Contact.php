<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;

/**
 * Class Contact
 * This object represents a phone contact.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#contact
 */
class Contact extends BaseObject
{
    /**
     * @inheritdoc
     */
    protected static function fields()
    {
        return [
            'phone_number' => ScalarString::class,
            'first_name' => ScalarString::class,
            'last_name' => ScalarString::class,
            'user_id' => ScalarInteger::class,
        ];
    }

    /**
     * @inheritdoc
     */
    protected static function requiredFields()
    {
        return [
            'phone_number',
            'first_name',
        ];
    }
}