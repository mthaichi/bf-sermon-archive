<?php

namespace BF_PluginBase;
/**
 * Singleton trait
 */
trait Singleton
{
	static $instance = null;

    protected final function __construct() {}

    public static function get_instance()
    {
        static $instance = null;
        return $instance ?: $instance = new static;
    }

    function __clone()
    {
        throw new RuntimeException("You can't clone this instance.");
    }
}