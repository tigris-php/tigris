<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;

/**
 * Class File
 * @package Tigris\Types
 *
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
}