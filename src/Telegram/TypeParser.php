<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram;

use Tigris\Telegram\Exceptions\TypeException;
use Tigris\Telegram\Types\Interfaces\TypeInterface;

class TypeParser
{
    public static function parse($typeDef, $data)
    {
        if (is_null($data)) {
            return null;
        }

        if ($data instanceof TypeInterface) {
            if ($data instanceof $typeDef) {
                return $data;
            } else {
                throw new TypeException('Unexpected input type: ' . get_class($data));
            }
        }

        if (is_string($typeDef)) {
            $typeDef = [$typeDef];
        }

        if (!is_array($typeDef)) {
            throw new \InvalidArgumentException('Invalid type definition: ' . $typeDef);
        }
    }
}