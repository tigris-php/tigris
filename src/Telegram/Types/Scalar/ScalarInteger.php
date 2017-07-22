<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types\Scalar;

use Tigris\Telegram\Types\Base\BaseScalar;

/**
 * Class ScalarInteger
 * @package Tigris\Types
 */
abstract class ScalarInteger extends BaseScalar
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