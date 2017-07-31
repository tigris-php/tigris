<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

namespace Tigris\Sessions;

class SQLiteSessionFactory extends AbstractSessionFactory
{
    /** @var \PDO */
    public $storage;

    public function __construct($dbPath)
    {
        $opt = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];

        $this->storage = new \PDO('sqlite:' . $dbPath, 'root', 'password', $opt);
        $statement = $this->storage->prepare("CREATE TABLE IF NOT EXISTS sessions (
                   session_id TEXT,
                   session_key TEXT,
                   session_value TEXT,
                   UNIQUE(session_id, session_key)
                   );");
        $statement->execute();
    }

    /**
     * @param @inheritdoc
     */
    public function getSession($sessionId)
    {
        if (!$sessionId) {
            throw new \InvalidArgumentException('sessionId argument must be set');
        }
        $session = SQLiteSession::create($sessionId);
        $session->storage = $this->storage;
        return $session;
    }
}