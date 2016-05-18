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
 * @package Tigris\Types
 *
 * @property ScalarInteger $id
 * @property ScalarString $first_name
 * @property ScalarString $last_name
 * @property ScalarString $username
 */
class User extends BaseObject
{
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