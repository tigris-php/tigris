<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Scalar;

use Tigris\Types\Base\BaseScalar;

/**
 * Class ScalarString
 * @package Tigris\Types
 */
abstract class ScalarString extends BaseScalar
{
    /**
     * @inheritdoc
     * @return string
     */
    public static function readData($data)
    {
        return (string) $data;
    }
}