<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseScalar;

/**
 * Class ScalarInteger
 * @package Tigris\Types
 *
 * @property integer $value
 */
class ScalarInteger extends BaseScalar
{
    /**
     * @inheritdoc
     * @return integer
     */
    public static function readData($data)
    {
        return (integer) $data;
    }
}