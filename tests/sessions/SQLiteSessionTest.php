<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */
use Tigris\Sessions\SQLiteSession;
use Tigris\Sessions\SQLiteSessionFactory;

class SQLiteSessionTest extends PHPUnit_Framework_TestCase
{
    private function getDbPath()
    {
        return sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'test1.sql';
    }

    public function testCreate()
    {
        $factory = new SQLiteSessionFactory($this->getDbPath());
        $session = $factory->getSession('test_id');
        $this->assertInstanceOf(SQLiteSession::class, $session);
        $this->assertSame('test_id', $session->getSessionId());

        $session->set('test', 'test');
        $getResult = $session->get('test');
        $this->assertSame('test', $getResult);

        $session->set('integer_value', 123);
        $this->assertSame(123, $session->get('integer_value'));

        $session->set('test_zero_value', 0);
        $this->assertSame(0, $session->get('test_zero_value'));

        $session->set('test', ['a', 'b', 'c']);
        $getResult = $session->get('test');
        $this->assertSame(['a', 'b', 'c'], $getResult);

        $session->set('test', null);
        $this->assertNull($session->get('test'));

        $session->set('new_key', 'new_value');
        $session->clear('new_key');
        $this->assertNull($session->get('new_key'));

        $session->set('test1', 'test1');
        $session->reset();
        $this->assertNull($session->get('test1'));

        try {
            $session->set(false, '123');
            $this->fail("Not exceptions");
        } catch (Exception $e) {
            $this->assertInstanceOf(\InvalidArgumentException::class, $e);
        }

        @unlink($this->getDbPath());
    }
}