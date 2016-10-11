<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Sessions;

abstract class AbstractSession
{
    const STATE_INDEX = '_STATE_';

    /** @var integer */
    protected $sessionId;

    /**
     * @param integer $sessionId
     * @return static
     */
    public static function create($sessionId)
    {
        $instance = new static();
        $instance->sessionId = $sessionId;
        return $instance;
    }

    /**
     * @return integer
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * Returns value by key
     *
     * @param string $index
     * @param null|mixed $defaultValue
     * @return mixed
     */
    abstract public function get($index, $defaultValue = null);

    /**
     * Sets value by key
     *
     * @param string $index
     * @param mixed $value
     */
    abstract public function set($index, $value);

    /**
     * Clears value by key
     *
     * @param string $index
     */
    abstract public function clear($index);

    /**
     * Clears the session storage
     */
    abstract public function reset();

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->set(static::STATE_INDEX, $state);
    }

    /**
     * @return mixed|null
     */
    public function getState()
    {
        return $this->get(static::STATE_INDEX);
    }

    /**
     * Clears the state
     */
    public function clearState()
    {
        return $this->clear(static::STATE_INDEX);
    }
}