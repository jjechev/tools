<?php

class View
{

    protected static $log = array();
    protected static $enableLog = false;

    public static function template($filename, $dataf22ewfbhqw21qg34g4 = array(), $logVariables = false)
    {
        $file = dirname(__FILE__) . '/views/' . $filename . '.tpl.php';
        if (!file_exists($file)) {
            self::log("Template not exists :" . $file);
            return;
        }

        if ($logVariables === false) {
            self::$log($file);
        }
        else {
            self::$log($file . " : " . print_r($dataf22ewfbhqw21qg34g4, true));
        }

        extract($dataf22ewfbhqw21qg34g4);
        unset($dataf22ewfbhqw21qg34g4);
        ob_start();
        include($file);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public static function enableLog()
    {
        self::$enableLog = true;
    }

    public static function disableLog()
    {
        self::$enableLog = false;
    }

    public static function getLog()
    {
        return self::$log;
    }

    private static function log($data)
    {
        if (self::$enableLog) {
            self::$log[] = $data;
        }
    }

}
