<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;

/**
 * Class Chat
 * @package Tigris\Types
 *
 * @property ScalarInteger $id
 * @property ScalarString $type
 * @property ScalarString $title
 * @property ScalarString $username
 * @property ScalarString $first_name
 * @property ScalarString $last_name
 */
class Chat extends BaseObject
{
    protected static function fields()
    {
        return [
            'id' => ScalarInteger::class,
            'type' => ScalarString::class,
            'title' => ScalarString::class,
            'username' => ScalarString::class,
            'first_name' => ScalarString::class,
            'last_name' => ScalarString::class,
        ];
    }
}