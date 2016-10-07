<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Session;

class InMemorySession extends AbstractSession
{
    /** @var \ArrayObject */
    public $storage;

    protected function __construct()
    {
        $this->storage = new \ArrayObject();
    }

    /**
     * @param @inheritdoc
     */
    public function get($index, $defaultValue = null)
    {
        return $this->storage->offsetExists($index) ? $this->storage->offsetGet($index) : $defaultValue;
    }

    /**
     * @inheritdoc
     */
    public function set($index, $value)
    {
        $this->storage->offsetSet($index, $value);
    }

    /**
     * @inheritdoc
     */
    public function clear($index)
    {
        $this->storage->offsetUnset($index);
    }

    /**
     * @inheritdoc
     */
    public function reset()
    {
        $this->storage->exchangeArray([]);
    }
}