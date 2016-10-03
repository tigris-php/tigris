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
 * @property string $phone_number Contact's phone number.
 * @property string $first_name Contact's first name.
 * @property string $last_name Optional. Contact's last name.
 * @property integer $user_id Optional. Contact's user identifier in Telegram.
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