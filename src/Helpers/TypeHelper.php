<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Helpers;

use Tigris\Types\Base\BaseArray;
use Tigris\Types\Base\BaseObject;

class TypeHelper
{
    public static function jsonEncode($value, $encode = true)
    {
        $result = null;

        if (is_scalar($value)) {
            $result = $value;
        } elseif ($value instanceof BaseObject || $value instanceof BaseArray) {
            $array = $value->getArrayCopy();
            array_walk($array, function(&$item) {
                $item = static::jsonEncode($item, false);
            });
            $result = array_filter($array);
        }

        return $encode ? json_encode($result) : $result;
    }
}