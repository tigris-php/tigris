<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */
use Tigris\Sessions\SQLiteSessionFactory;

class SQLiteSessionFactoryTest extends PHPUnit_Framework_TestCase
{
    private function getDbPath()
    {
        $path =  sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'test1.sql';
        @unlink(@$path);

        return $path;
    }

    public function testConstruct()
    {
        $factory = new SQLiteSessionFactory($this->getDbPath());
        $this->assertInstanceOf(SQLiteSessionFactory::class, $factory);
        $this->assertAttributeInstanceOf(PDO::class, 'storage', $factory);
        $this->assertFileExists($this->getDbPath());
    }

    public function testGetSession()
    {
        $f = new SQLiteSessionFactory($this->getDbPath());
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

        @unlink($this->getDbPath());
    }
}