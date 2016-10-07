<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Session;

class InMemorySessionFactory extends AbstractSessionFactory
{
    /** @var \ArrayObject */
    public $storage;

    public function __construct()
    {
        $this->storage = new \ArrayObject();
    }

    /**
     * @param @inheritdoc
     */
    public function getSession($sessionId)
    {
        if (!$this->storage->offsetExists($sessionId)) {
            $this->storage->offsetSet($sessionId, InMemorySession::create($sessionId));
        }
        return $this->storage->offsetGet($sessionId);
    }
}