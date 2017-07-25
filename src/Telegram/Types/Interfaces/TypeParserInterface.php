<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types\Interfaces;

/**
 * Interface TypeParserInterface
 * @package Tigris\Types\Interfaces
 */
interface TypeParserInterface
{
    /**
     * @param string $type
     * @param mixed $data
     * @return null|static
     */
    public function parse($type, $data);
}