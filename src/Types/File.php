<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;

/**
 * Class File
 * This object represents a file ready to be downloaded.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#file
 *
 * @property ScalarString $file_id
 * @property ScalarInteger $file_size
 * @property ScalarString $file_path
 */
class File extends BaseObject
{
    /**
     * @inheritdoc
     */
    protected static function fields()
    {
        return [
            'file_id' => ScalarString::class,
            'file_size' => ScalarInteger::class,
            'file_path' => ScalarString::class,
        ];
    }

    /**
     * @inheritdoc
     */
    protected static function requiredFields()
    {
        return [
            'file_id',
        ];
    }
}