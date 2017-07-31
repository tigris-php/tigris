<?php
/**
 * @author Antonov Oleg <theorder83dev@gmail.com>
 */
use Tigris\Sessions\SQLiteSession;
use Tigris\Sessions\SQLiteSessionFactory;

class SQLiteSessionGetSessionTest extends PHPUnit_Framework_TestCase
{
    private function getDbPath()
    {
        $path =  sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'test1.sql';
        @unlink($path);

        return $path;
    }

    public function testRepeatedGetSession()
    {
        $path = $this->getDbPath();
        $factory = new SQLiteSessionFactory($path);
        $session = $factory->getSession('test_id');
        $this->assertInstanceOf(SQLiteSession::class, $session);
        $this->assertSame('test_id', $session->getSessionId());

        $session->set('offset', 10);
        $getResult = $session->get('offset');
        $this->assertSame(10, $getResult);

        $session = $factory->getSession('test_id');
        $this->assertInstanceOf(SQLiteSession::class, $session);
        $this->assertSame('test_id', $session->getSessionId());

        $getResult = $session->get('offset');
        $this->assertSame(10, $getResult);

        @unlink($this->getDbPath());
    }
}