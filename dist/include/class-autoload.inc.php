<?php
// using this myAutoLoader name the file as same in your class name
// Exmaple..=====================================
// *Class name:
// class Calc {...}
// *File name:
// calc.inc.php
// Note: it's not case sensitive;

spl_autoload_register('myAutoLoader');

function myAutoLoader ($className){ // built in method called myAutoLoader() for auto reload.
	$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

	if (strpos($url, 'include') !== false) { // path finding?
		$path = '../classes/';
	}
	else {
		$path = 'classes/';
	}

	$extension = '.class.php';
	$fullPath = $path . $className . $extension;
	// check if class is exist. NOTE: double check your class name or file name.
	if (!file_exists($fullPath)) {
		return false;
	}

	require_once $fullPath;
}

?>