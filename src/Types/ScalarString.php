<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseScalar;

/**
 * Class ScalarString
 * @package Tigris\Types
 *
 * @property string $value
 */
class ScalarString extends BaseScalar
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