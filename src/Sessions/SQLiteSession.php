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
        $statement = $this->storage->prepare("SELECT session_value FROM sessions WHERE  session_id = ? AND session_key = ?");
        if ($statement->execute([$this->getSessionId(), $index])) {
            $json_result = ArrayHelper::getValue($statement->fetch(), 'session_value');
            return strlen($json_result) ? \GuzzleHttp\json_decode($json_result) : $defaultValue;
        }
        return $defaultValue;
    }

    /**
     * @inheritdoc
     */
    public function set($index, $value = null)
    {
        $statement = $this->storage->prepare("INSERT INTO sessions (session_key, session_value, session_id) VALUES (?,?,?)");
        $statement->execute([$index, \GuzzleHttp\json_encode($value), $this->getSessionId()]);
    }

    /**
     * @inheritdoc
     */
    public function clear($index)
    {
        $statement = $this->storage->prepare("DELETE FROM sessions  WHERE  session_id = ? AND session_key = ?");
        $statement->execute([$this->sessionId, $index]);
    }

    /**
     * @inheritdoc
     */
    public function reset()
    {
        $statement = $this->storage->prepare("DELETE  FROM sessions WHERE session_id = ?");
        $statement->execute([$this->sessionId]);
    }
}