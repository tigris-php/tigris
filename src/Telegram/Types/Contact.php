<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarInteger;
use Tigris\Telegram\Types\Scalar\ScalarString;

/**
 * Class Contact
 * This object represents a phone contact.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#contact
 *
 * @property string $phone_number
 * @property string $first_name
 * @property string|null $last_name
 * @property int|null $user_id
 */
class Contact extends BaseObject
{
    public static function fields()
    {
        return [
            'phone_number' => ScalarString::class,
            'first_name' => ScalarString::class,
            'last_name' => ScalarString::class,
            'user_id' => ScalarInteger::class,
        ];
    }
}