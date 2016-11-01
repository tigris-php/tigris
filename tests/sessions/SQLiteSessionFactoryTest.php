<?php


use \Tigris\Sessions\SQLiteSessionFactory;
use Tigris\Exceptions\TelegramTypeException;

class SQLiteSessionFactoryTest extends PHPUnit_Framework_TestCase
{
    private $basePath = '/tmp';
    private $baseName = 'base.sql';



    public function testConstruct()
    {

        $factory  = new SQLiteSessionFactory($this->basePath.DIRECTORY_SEPARATOR.$this->baseName);
        $this->assertInstanceOf(SQLiteSessionFactory::class, $factory);
        $this->assertAttributeInstanceOf(PDO::class, 'storage', $factory);
        $this->assertContains($this->baseName, scandir($this->basePath));
    }

    public function testGetSession()
    {
        $f  = new SQLiteSessionFactory($this->basePath.DIRECTORY_SEPARATOR.$this->baseName);
        $a = $f->getSession(1);
        $this->assertInstanceOf(\Tigris\Sessions\SQLiteSession::class, $a);
        $this->assertAttributeInstanceOf(\PDO::class, 'storage', $a);

        $this->assertAttributeSame(1, 'sessionId', $a);

        $z = $f->getSession(null);
        $this->assertNull($z);

        $b = $f->getSession(-1);
        $this->assertNull($b);

        $c = $f->getSession('1');
        $this->assertInstanceOf(\Tigris\Sessions\SQLiteSession::class, $c);

        unlink($this->basePath.DIRECTORY_SEPARATOR.$this->baseName);

    }
}