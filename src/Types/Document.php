<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;

/**
 * Class Document
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#document
 */
class Document extends BaseObject
{
    /**
     * @inheritdoc
     */
    protected static function fields()
    {
        return [
            'file_id' => ScalarString::class,
            'thumb' => PhotoSize::class,
            'file_name' => ScalarString::class,
            'mime_type' => ScalarString::class,
            'file_size' => ScalarInteger::class,
        ];
    }
}