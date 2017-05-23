<?php
date_default_timezone_set('PRC');
spl_autoload_register(function ($className) {
    $className = str_replace('zqzlk\\','',$className);
    $filePath = __DIR__."\\{$className}.php";
	$filePath = str_replace('\\',DIRECTORY_SEPARATOR,$filePath);
    if (file_exists($filePath)) {
        require($filePath);
    }
});
