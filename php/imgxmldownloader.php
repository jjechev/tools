<?php

set_time_limit(0);
ini_set('default_socket_timeout', 900);

\App::main();

class App
{

    private static $xmlFile = "import.xml";
    private static $newxmlFile = "importnew.xml";
    private static $imagePath = "/data/tmp/pics";

    public static function main()
    {
        self::process();
    }

    public static function process()
    {
        $xml = simpleXML_load_file(self::$xmlFile, "SimpleXMLElement", LIBXML_NOCDATA);

        foreach ($xml->Offers->Item as $Item) {
            foreach ($Item->Images->Image as $image) {
                self::getImage($image);
            }
        }
    }

    private static function getImage($url)
    {
        $logElements = array();
        $startTime = microtime(true);
        $url = (string) $url;
        $name = end(explode("/", $url));

        $filename = self::$imagePath . "/" . $name;

        $result = file_put_contents($filename, file_get_contents($url));

        $endTime = microtime(true);
        $execTime = number_format($endTime - $startTime, 5);

        $logElements[] = $url;
        $logElements[] = $result;
        $logElements[] = $execTime;

        Log::set(implode(',', $logElements));
    }

}

class Log
{

    private static $logFile = "log.txt";
    private static $resetLog = false;

    public static function set($text)
    {
        if (!self::$resetLog) {
            self::resetLogFile();
            self::$resetLog = true;

            self::save("date, url, size, time");
        }

        self::save($text);
    }

    private static function resetLogFile()
    {
        file_put_contents(self::$logFile, '');
    }

    private static function save($text)
    {
        $time = date("c");
        $data = $time . "," . $text . "\n";

        file_put_contents(self::$logFile, $data, FILE_APPEND);
    }

}
