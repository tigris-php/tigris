<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */
use Tigris\Sessions\SQLiteSessionFactory;

class SQLiteSessionFactoryTest extends PHPUnit_Framework_TestCase
{
    private $basePath = '/tmp';
    private $baseName = 'base.sql';

    public function testConstruct()
    {
        $factory = new SQLiteSessionFactory($this->basePath . DIRECTORY_SEPARATOR . $this->baseName);
        $this->assertInstanceOf(SQLiteSessionFactory::class, $factory);
        $this->assertAttributeInstanceOf(PDO::class, 'storage', $factory);
        $this->assertContains($this->baseName, scandir($this->basePath));
    }

    public function testGetSession()
    {
        $f = new SQLiteSessionFactory($this->basePath . DIRECTORY_SEPARATOR . $this->baseName);
        $a = $f->getSession(1);
        $this->assertInstanceOf(\Tigris\Sessions\SQLiteSession::class, $a);
        $this->assertAttributeInstanceOf(\PDO::class, 'storage', $a);

        $this->assertAttributeSame(1, 'sessionId', $a);

        try {
            $f->getSession(null);
            $this->fail("Expected exception not been received");
        } catch (Exception $e) {
            $this->assertInstanceOf(\InvalidArgumentException::class, $e);
        }

        $c = $f->getSession('1');
        $this->assertInstanceOf(\Tigris\Sessions\SQLiteSession::class, $c);

        unlink($this->basePath . DIRECTORY_SEPARATOR . $this->baseName);
    }
}