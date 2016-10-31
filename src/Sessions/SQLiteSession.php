<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */
namespace Tigris\Sessions;

class SQLiteSession extends AbstractSession
{
    /** @var \PDO */
    public $storage;



    /**
     * @param @inheritdoc
     */
    public function get($index, $defaultValue = null)
    {

    }

    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * @inheritdoc
     */
    public function set($index, $value)
    {
        $statement = $this->storage->prepare("UPDATE sessions SET session_key = ?, session_value = ?  WHERE  session_id = ?;");
        return $statement->execute([$index, $value, $this->getSessionId()]);

    }

    /**
     * @inheritdoc
     */
    public function clear($index)
    {

    }

    /**
     * @inheritdoc
     */
    public function reset()
    {

    }
}