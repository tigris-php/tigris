<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Scalar;

use Tigris\Types\Base\BaseScalar;

/**
 * Class ScalarBoolean
 * @package Tigris\Types
 */
abstract class ScalarBoolean extends BaseScalar
{
    /**
     * @inheritdoc
     * @return boolean
     */
    public static function readData($data)
    {
        return (boolean) $data;
    }
}