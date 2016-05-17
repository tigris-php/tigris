<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Base;

use Tigris\Traits\JsonTrait;
use Tigris\Types\Interfaces\TypeInterface;

abstract class BaseScalar implements TypeInterface
{
    use JsonTrait;

    public $value;

    /**
     * @inheritdoc
     */
    public static function build($data)
    {
        if ($data instanceof TypeInterface) {
            return $data;
        }

        if (is_null($data)) {
            return null;
        }

        $obj = new static;
        $obj->value = static::readData($data);
        return $obj;
    }

    public static function readData($data)
    {
        return $data;
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return (string) $this->value;
    }
}