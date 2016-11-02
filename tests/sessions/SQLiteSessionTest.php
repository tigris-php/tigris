<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */
use Tigris\Sessions\SQLiteSession;
use Tigris\Sessions\SQLiteSessionFactory;

class SQLiteSessionTest extends PHPUnit_Framework_TestCase
{
    private $basePath = '/tmp';
    private $baseName = 'base1.sql';

    public function testCreate()
    {
        $factory = new SQLiteSessionFactory($this->basePath . DIRECTORY_SEPARATOR . $this->baseName);
        $session = $factory->getSession('test_id');
        $this->assertInstanceOf(SQLiteSession::class, $session);
        $this->assertSame('test_id', $session->getSessionId());

        $session->set('test', 'test');
        $getResult = $session->get('test');
        $this->assertSame('test', $getResult);

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

        unlink($this->basePath . DIRECTORY_SEPARATOR . $this->baseName);
    }
}