<?php
use Tigris\Sessions\SQLiteSessionFactory;
use Tigris\Sessions\SQLiteSession;

class SQLiteSessionTest extends PHPUnit_Framework_TestCase
{
    private $basePath = '/tmp';
    private $baseName = 'base1.sql';

    public function testCreate()
    {
        $factory = new SQLiteSessionFactory($this->basePath.DIRECTORY_SEPARATOR.$this->baseName);
        $session = $factory->getSession(21);
        $this->assertInstanceOf(SQLiteSession::class, $session);
        $this->assertSame(21, $session->getSessionId());

        $session->set('test','test');

        $getResult = $session->get('test');
        $this->assertSame('test', $getResult);

        try {
            $session->set('test','test');
            $this->fail("PDO exception isn't received");
        } catch (Exception $e) {
            $this->assertInstanceOf(\PDOException::class, $e);
        }

        $session->clear('test');
        $this->assertNull($session->get('test'));



        $session->set('test1','test1');
        $session->reset();
        $this->assertNull($session->get('test1'));

        unlink($this->basePath.DIRECTORY_SEPARATOR.$this->baseName);

    }








}