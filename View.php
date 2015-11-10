<?php

class View{

	protected static $usedViews = array();
	
	public static function template($filename, $dataf22ewfbhqw21qg34g4 = array())
	{
		$file = dirname(__FILE__) . '/views/' . $filename . '.tpl.php';
		if (!file_exists($file))
			return;
                self::$usedViews[] = $file;
                //self::$usedViews[] = $file . " : ". print_r($dataf22ewfbhqw21qg34g4,true);
                
		extract($dataf22ewfbhqw21qg34g4);
		unset($dataf22ewfbhqw21qg34g4);
		ob_start();
		include($file);
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}
	
	public static function getUsedViews()
	{
		return self::$usedViews;
	}
}
