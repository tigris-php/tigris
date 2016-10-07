<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Session;

abstract class AbstractSessionFactory
{
    /**
     * @param integer $sessionId
     * @return AbstractSession
     */
    abstract public function getSession($sessionId);
}