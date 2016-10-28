<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Plugins;

class PollingReceiver extends AbstractPlugin
{
    public $pollingInterval = 1;

    public $offset = 0;

    public $lastUpdateFile = 'last_update.txt';

    public function bootstrap()
    {
        $this->offset = $this->getLastOffset();

        $loop = $this->bot->getLoop();
        $loop->addPeriodicTimer($this->pollingInterval, function () {
//            $memory = memory_get_usage() / 1024;
//            $formatted = number_format($memory, 3) . 'K';
//            echo "Current memory usage: {$formatted}\n";

            $updates = $this->bot->getApi()->getUpdates($this->offset);

            foreach ($updates as $update) {
                $this->offset = $update->update_id + 1;
                $this->setLastOffset($this->offset);
                $this->bot->getUpdateQueue()->insert($update, $update->update_id);
            }
        });
    }

    /**
     * @return string
     */
    protected function getLastUpdateFilePath()
    {
        return $this->bot->getStorageDir() . DIRECTORY_SEPARATOR . $this->lastUpdateFile;
    }

    /**
     * @return int
     */
    protected function getLastOffset()
    {
        $path = $this->getLastUpdateFilePath();
        if (is_readable($path)) {
            return (integer) file_get_contents($path);
        } else {
            return 0;
        }
    }

    /**
     * @param $offset
     */
    protected function setLastOffset($offset)
    {
        $path = $this->getLastUpdateFilePath();
        file_put_contents($path, $offset);
    }
}