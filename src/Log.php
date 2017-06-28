<?php

namespace AbuseIO\Hook;

use AbuseIO\Hook\HookInterface;
use Log as Logger;

class Log implements HookInterface
{
    const INIFILE = "../config/log.ini";

    /**
     * dictated by HookInterface
     * the method called from hook-common
     *
     * simple example method that logs when the hook is called
     */
    static public function call($object, $event)
    {
        if (self::isEnabled()) {
            Logger::info(__CLASS__ . " called with object $object and event $event");
        }
    }

    /**
     * is this hook enabled
     *
     * @return bool
     */
    static public function isEnabled() {
        $ini = parse_ini_file(realpath(dirname(__FILE__)) . "/" . self::INIFILE);

        return (array_key_exists('enabled', $ini) && $ini['enabled'] == true);
    }
}