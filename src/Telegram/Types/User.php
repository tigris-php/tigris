<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarInteger;
use Tigris\Telegram\Types\Scalar\ScalarString;

/**
 * Class User
 * This object represents a Telegram user or bot.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#user
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $language_code
 */
class User extends BaseObject
{
    /**
     * @inheritdoc
     */
    protected static function fields()
    {
        return [
            'id' => ScalarInteger::class,
            'first_name' => ScalarString::class,
            'last_name' => ScalarString::class,
            'username' => ScalarString::class,
            'language_code' => ScalarString::class,
        ];
    }
}