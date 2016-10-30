<?php


use \Tigris\Sessions\SQLiteSessionFactory;
class SQLiteSessionFactoryTest extends PHPUnit_Framework_TestCase
{
    private $basePath = '/tmp';
    private $baseName = 'base.sql';

    public function testConstruct()
    {
        $a = new SQLiteSessionFactory($this->basePath.DIRECTORY_SEPARATOR.$this->baseName);
        $this->assertInstanceOf(SQLiteSessionFactory::class, $a);
        $this->assertAttributeInstanceOf(PDO::class, 'storage', $a);
        $this->assertContains($this->baseName, scandir($this->basePath));

    }


    public function testGetSession()
    {

        $sessionId = 1;
        $a = new SQLiteSessionFactory($this->basePath.DIRECTORY_SEPARATOR.$this->baseName);
        $session = $a->getSession($sessionId);
        $this->assertInstanceOf(\Tigris\Sessions\SQLiteSession::class, $session);
        $this->assertAttributeInstanceOf(PDO::class, 'storage', $session);

        $z = $a->getSession(null);
        $this->assertNull($z);

        $e = $a->getSession(-123);
        $this->assertNull($e);

        unlink($this->basePath.DIRECTORY_SEPARATOR.$this->baseName);
    }
}