<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Base;

use Tigris\Helpers\ArrayHelper;
use Tigris\Telegram\Exceptions\TypeException;
use Tigris\Traits\JsonTrait;
use Tigris\Types\Interfaces\TypeInterface;

abstract class BaseObject extends \ArrayObject implements TypeInterface
{
    use JsonTrait;

//    public function __construct($input = null, $flags = 0, $iterator_class = "ArrayIterator") {
//        parent::__construct($input, static::ARRAY_AS_PROPS, $iterator_class);
//    }

    /**
 * @inheritdoc
 * @return static
 */
    public static function parse($data)
    {
        if (is_null($data)) {
            return null;
        }

        if ($data instanceof TypeInterface) {
            if ($data instanceof static) {
                return $data;
            } else {
                throw new TypeException('Unexpected input type: ' . get_class($data));
            }
        }

        if (!is_array($data)) {
            throw new TypeException('Input must be an array');
        }

        if (count($data) == null) {
            throw new TypeException('Unexpected empty array');
        }

        $result = new static;

        foreach (static::fields() as $field => $className) {
            /** @var $className TypeInterface */
            $result->offsetSet($field, $className::parse(ArrayHelper::getValue($data, $field)));
        }

        return $result;
    }

    /**
     * Builds object from array of field values indexed by field name.
     *
     * @param array $values
     * @return static
     */
    public static function build(array $values)
    {
        $result = new static;

        foreach ($values as $field=> $value) {
            /** @var $className TypeInterface */
            $result->$field = $value;
        }

        return $result;
    }

    /**
     * @return array
     */
    protected static function fields()
    {
        return [];
    }

    public function __get($name)
    {
        return $this->offsetGet($name);
    }

    public function __set($name, $value)
    {
        $this->offsetSet($name, $value);
    }

    public function __toString()
    {
        if ($this->offsetExists('id')) {
            return $this->offsetGet('id');
        } else {
            return false;
        }
    }
}