<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris;

use Tigris\Telegram\Types\Updates\Update;

/**
 * Class UpdatesQueue
 * @package Tigris
 *
 * @method Update extract()
 */
class UpdateQueue extends \SplPriorityQueue
{

}