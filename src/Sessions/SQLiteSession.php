<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */
namespace Tigris\Sessions;

use Tigris\Helpers\ArrayHelper;

class SQLiteSession extends AbstractSession
{
    /** @var \PDO */
    public $storage;



    /**
     * @param @inheritdoc
     */
    public function get($index, $defaultValue = null)
    {
        $statement = $this->storage->prepare("SELECT session_value from sessions WHERE  session_id = ? AND session_key = ?;");
        return $statement->execute([$this->getSessionId(), $index]) ? ArrayHelper::getValue($statement->fetch(),'session_value') : $defaultValue;
    }

    /**
     * @inheritdoc
     */
    public function set($index, $value)
    {

        $statement = $this->storage->prepare("INSERT INTO sessions (session_id, session_key, session_value) VALUES (?,?,?);");
        $statement->execute([$this->getSessionId(), $index, $value]);

    }

    /**
     * @inheritdoc
     */
    public function clear($index)
    {
        $statement = $this->storage->prepare("UPDATE sessions SET  session_value = NULL  WHERE  session_id = ? AND session_key = ?;");
        $statement->execute([$this->sessionId, $index]);

    }

    /**
     * @inheritdoc
     */
    public function reset()
    {
        $statement = $this->storage->prepare("DELETE  FROM sessions WHERE session_id = ?;");
        $statement->execute([$this->sessionId]);
    }
}