<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Base;

use Tigris\Helpers\ArrayHelper;
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
     */
    public static function build($data)
    {
        if ($data instanceof TypeInterface) {
            return $data;
        }

        if (empty($data)) {
            return null;
        }

        $obj = new static;

        foreach (static::fields() as $field => $className) {
            /** @var $className BaseObject */
            $obj->offsetSet($field, $className::build(ArrayHelper::getValue($data, $field)));
        }

        return $obj;
    }

    /**
     * @return array
     */
    protected static function fields()
    {
        return [];
    }

    /**
     * @return array
     */
    protected static function requiredFields()
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