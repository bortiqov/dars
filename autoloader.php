<?php
spl_autoload_register(function($className) {
	$file = __DIR__ . "/models/".$className.".php";
	if (file_exists($file))
	{
		include $file;
	}
}