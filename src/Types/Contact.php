<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;

/**
 * Class Contact
 * This object represents a phone contact.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#contact
 *
 * @property ScalarString $phone_number
 * @property ScalarString $first_name
 * @property ScalarString $last_name
 * @property ScalarInteger $user_id
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
}