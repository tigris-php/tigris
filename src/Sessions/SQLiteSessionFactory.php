<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */
namespace Tigris\Sessions;


use Tigris\Helpers\ArrayHelper;

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
                   session_id INTEGER PRIMARY KEY,
                   session_key TEXT,
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

        $getSession = $this->storage->prepare("SELECT session_id FROM sessions WHERE session_id=?");
        $getSession->execute([$sessionId]);


        if(!ArrayHelper::getValue($getSession->fetch(), 'session_id')) {
            $createSession = $this->storage->prepare("INSERT into sessions VALUES (?,'','');");
            $createSession->execute([$sessionId]);
            $getSession->execute([$sessionId]);
        }

        $getSession->execute([$sessionId]);

        $session = new SQLiteSession((integer) ArrayHelper::getValue($getSession->fetch(),'session_id'));
        $session->storage = $this->storage;
        return $session;
    }


}