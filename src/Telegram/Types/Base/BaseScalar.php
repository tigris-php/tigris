<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types\Base;

use Tigris\Telegram\TypeParser;
use Tigris\Telegram\Types\Interfaces\TypeInterface;

abstract class BaseScalar implements TypeInterface
{
    /**
     * @inheritdoc
     * @return mixed
     */
    public static function parse($data)
    {
        return TypeParser::parse(static::class, $data);
    }

    public static function readData($data)
    {
        return $data;
    }
}