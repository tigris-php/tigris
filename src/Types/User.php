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
 * @property ScalarInteger $id
 * @property ScalarString $first_name
 * @property ScalarString $last_name
 * @property ScalarString $username
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

    /**
     * @inheritdoc
     */
    protected static function requiredFields()
    {
        return [
            'id',
            'first_name',
        ];
    }
}