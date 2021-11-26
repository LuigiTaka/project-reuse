<?php

namespace ProjectReuse;

class Utils
{

	static function dump($data)
	{ 
		ob_start();
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		echo ob_get_clean();
	}

	static function mkdir(string $filepath)
	{ 
		if(is_dir($filepath)){ 
			return true;
		}

		return mkdir($filepath);
	}


}
