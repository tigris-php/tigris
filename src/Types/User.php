<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;

/**
 * Class User
 * This object represents a Telegram user or bot.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#user
 *
 * @property integer $id Unique identifier for this user or bot.
 * @property string $first_name User‘s or bot’s first name.
 * @property string $last_name Optional. User‘s or bot’s last name.
 * @property string $username Optional. User‘s or bot’s username.
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
        ];
    }
}