<?php

namespace AbuseIO\Hook;

use AbuseIO\Hook\HookInterface;
use Log as Logger;

class Log implements HookInterface
{
    const INIFILE = "../config/log.ini";

    /**
     * Log constructor.
     */
    public function __construct()
    {
        $this->config = parse_ini_file(realpath(dirname(__FILE__)) . "/" . self::INIFILE);
        if (array_key_exists('objects', $this->config)) {
            $this->objects = preg_split(',', $this->config['objects']);
        }
    }

    /**
     * dictated by HookInterface
     * the method called from hook-common
     *
     * simple example method that logs when the hook is called
     */
    public static function call($object, $event)
    {
        $objects = [];
        $config = parse_ini_file(realpath(dirname(__FILE__)) . "/" . self::INIFILE);
        if (array_key_exists('objects', $config))
        {
           $objects = preg_split(',',$config['objects']);
        }

        // only log if it is a valid object
        if (in_array(get_class($object), $objects)
        {
            Logger::info(__CLASS__ . " called with object $object and event $event");
        }
    }

    /**
     * is this hook enabled
     *
     * @return bool
     */
    public static function isEnabled()
    {
        $config = parse_ini_file(realpath(dirname(__FILE__)) . "/" . self::INIFILE);
        return (array_key_exists('enabled', $config) && $config['enabled'] == true);
    }
}