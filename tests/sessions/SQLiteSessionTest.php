<?php


use Tigris\Sessions\SQLiteSession;
class SQLiteSessionTest extends PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $a = SQLiteSession::create(11);
        $this->assertInstanceOf(SQLiteSession::class, $a);
    }
}