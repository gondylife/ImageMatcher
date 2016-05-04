<?php

function __autoload ($class) {
	$namespace = explode('\\', $class);
	$ns = array_splice($namespace, 1);
	$len = count($ns);
	$path = ($namespace[0] === APP_NS) ? MODS_DIR : '';
	for ($i = 0; $i < $len; $i++) {
		$path .= $ns[$i];
		if (($len - $i) === 1) {
			break;
		}
		$path .= DS;
	}
	$path .= '.class.php';
	if (file_exists($path) && is_file($path)) {
		require_once($path);
	}
}

function loadLibs () {
	$libs = scandir(LIBS_DIR);
	$exclude = array('.', '..', 'index.php', 'autoload.php');
	foreach ($libs as $lib) {
		if (!in_array($lib, $exclude)) {
			require_once(LIBS_DIR.$lib);
		}
	}
}

?>