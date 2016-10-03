<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Scalar;

use Tigris\Types\Base\BaseScalar;

/**
 * Class ScalarFloat
 * @package Tigris\Types
 */
abstract class ScalarFloat extends BaseScalar
{
    /**
     * @inheritdoc
     * @return float
     */
    public static function readData($data)
    {
        return (float) $data;
    }
}