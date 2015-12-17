<?php

/**
 * @param string $currentUrl
 * @param int $pos
 * @param array $langs
 * @return array
 */
function generateURLs($currentUrl, $pos, array $langs)
{

    $parts = explode("/", $currentUrl);

    $parts[$pos + 2] = "%s";

    $tempURL = implode("/", $parts);

    $URLs = array();
    foreach ($langs as $lang) {
        $URLs[] = sprintf($tempURL, $lang);
    }

    return $URLs;
}

$currentUrl = "http://test.site.com/en/about.php";
$pos = 1;
$langs = array("bg", 'ru', 'en', 'de', 'fr');

$urls = generateURLs($currentUrl, $pos, $langs);

var_dump($urls);
