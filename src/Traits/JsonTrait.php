<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Traits;

use Tigris\Helpers\ArrayHelper;

trait JsonTrait
{
    public function toJson()
    {
        return ArrayHelper::jsonEncode($this);
    }
}