<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;
use Tigris\Types\Scalar\ScalarInteger;

/**
 * Class UserProfilePhotos
 * @package Tigris\Types
 *
 * @link https://core.telegram.org/bots/api#userprofilephotos
 */
class UserProfilePhotos extends BaseObject
{
    /**
     * @inheritdoc
     */
    protected static function fields()
    {
        return [
            'total_count' => ScalarInteger::class,
            'photos' => PhotoSizeMatrix::class,
        ];
    }
}