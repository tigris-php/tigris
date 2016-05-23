<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Traits;

use Tigris\Helpers\TypeHelper;

trait JsonTrait
{
    public function toJson()
    {
        return TypeHelper::jsonEncode($this);
    }
}