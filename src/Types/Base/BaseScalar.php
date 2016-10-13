<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Base;

use Tigris\Types\Interfaces\TypeInterface;

abstract class BaseScalar implements TypeInterface
{
    /**
     * @inheritdoc
     * @return mixed
     */
    public static function parse($data)
    {
        if ($data instanceof TypeInterface) {
            return $data;
        }

        if (is_null($data)) {
            return null;
        }

        return static::readData($data);
    }

    public static function readData($data)
    {
        return $data;
    }
}