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

    /**
     * @inheritdoc
     */
    public function set($index, $value)
    {
        $statement = $this->storage->prepare("INSERT INTO SESSIONS (session_key, session_value) VALUES (:sessoion_key, :session_value)");
        $statement->bindParam(':session_key', $index);
        $statement->bindParam(':session_value', $value);
        $statement->execute();
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