<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Receivers;

class PollingReceiver extends AbstractReceiver
{
    public $pollingInterval = 1;

    public $offset = 0;

    protected function onSetBot()
    {
        $loop = $this->bot->getLoop();
        $loop->addPeriodicTimer($this->pollingInterval, function () {
//            $memory = memory_get_usage() / 1024;
//            $formatted = number_format($memory, 3) . 'K';
//            echo "Current memory usage: {$formatted}\n";

            $updates = $this->bot->getApi()->getUpdates($this->offset);

            foreach ($updates as $update) {
                $this->offset = $update->update_id + 1;
                $this->bot->getUpdatesQueue()->insert($update, $update->update_id);
            }
        });
    }
}