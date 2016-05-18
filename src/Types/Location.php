<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;
use Tigris\Types\Scalar\ScalarFloat;

/**
 * Class Location
 * This object represents a point on the map.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#location
 */
class Location extends BaseObject
{
    /**
     * @inheritdoc
     */
    protected static function fields()
    {
        return [
            'longitude' => ScalarFloat::class,
            'latitude' => ScalarFloat::class,
        ];
    }

    /**
     * @inheritdoc
     */
    protected static function requiredFields()
    {
        return [
            'longitude',
            'latitude',
        ];
    }
}