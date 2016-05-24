<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Interfaces;

/**
 * Interface TypeInterface
 * @package Tigris\Types\Interfaces
 */
interface TypeInterface
{
    /**
     * @param mixed $data
     * @return null|static
     */
    public static function build($data);
}