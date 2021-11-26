<?php

spl_autoload_register(function($class){
	$namespace = 'ProjectReuse';
    $parts = explode("\\",$class);

    if(array_shift($parts)!== $namespace){
        return;
    }

    $path = __DIR__."/src/".implode("/",$parts).'.php';

    if(!file_exists($path)){
        throw new \Exception("TracaReuse class not found: $class");
    }

    require_once($path);

});
