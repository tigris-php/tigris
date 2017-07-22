<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarInteger;
use Tigris\Telegram\Types\Scalar\ScalarString;

/**
 * Class File
 * This object represents a file ready to be downloaded.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#file
 *
 * @property string $file_id Unique identifier for this file.
 * @property integer $file_size Optional. File size, if known.
 * @property string $file_path Optional. File path.
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