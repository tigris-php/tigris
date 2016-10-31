<?php
use Tigris\Sessions\SQLiteSessionFactory;
use Tigris\Sessions\SQLiteSession;

class SQLiteSessionTest extends PHPUnit_Framework_TestCase
{
    private $basePath = '/tmp';
    private $baseName = 'base.sql';

    public function testCreate()
    {
        $factory = new SQLiteSessionFactory($this->basePath.DIRECTORY_SEPARATOR.$this->baseName);
        $session = $factory->getSession(21);
        $this->assertInstanceOf(SQLiteSession::class, $session);
    }
}