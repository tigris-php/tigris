<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */
namespace Tigris\Sessions;


use Tigris\Exceptions\TelegramTypeException;

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
                   session_key TEXT UNIQUE,
                   session_value TEXT);
                   ");

        $statement->execute();
    }

    /**
     * @param @inheritdoc
     */
    public function getSession($sessionId)
    {

        if(!$sessionId || $sessionId <= 0) {
            return null;
        }

        $session =  SQLiteSession::create($sessionId);
        $session->storage = $this->storage;
        return $session;
    }


}