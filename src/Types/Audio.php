<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;

/**
 * Class Audio
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#audio
 */
class Audio extends BaseObject
{
    protected static function fields()
    {
        return [
            'file_id' => ScalarString::class,
            'duration' => ScalarInteger::class,
            'performer' => ScalarString::class,
            'title' => ScalarString::class,
            'mime_type' => ScalarString::class,
            'file_size' => ScalarInteger::class,
        ];
    }
}