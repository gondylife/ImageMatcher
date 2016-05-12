<?php

ob_start();
use App\Core\Database as Database;
use App\Core\Session as Session;

defined('DIRECTORY_SEPERATOR') ? null : define('DIRECTORY_SEPERATOR', '/');
defined('DS') ? null : define('DS', DIRECTORY_SEPERATOR);

// Resolving Http Host
switch ($_SERVER['HTTP_HOST']) {
	case 'localhost':
		defined('SITE_HOST') ? null : define('SITE_HOST', 'imagematcher');
		defined('ROOT_DIR') ? null : define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'] . DS . SITE_HOST . DS);
		defined('BASE_URL') ? null : define('BASE_URL', $_SERVER['REQUEST_SCHEME'] . ':' . DS . DS . $_SERVER['HTTP_HOST'] . DS . SITE_HOST . DS);
		defined('DB_HOST') ? null : define('DB_HOST', 'localhost');
		defined('DB_USER') ? null : define('DB_USER', 'root');
		defined('DB_PSWD') ? null : define('DB_PSWD', '*1wAY2HvN');
		defined('DB_NAME') ? null : define('DB_NAME', 'imagematcher');
		break;
	case 'npfims.com':
		defined('SITE_HOST') ? null : define('SITE_HOST', 'npfims.com');
		defined('ROOT_DIR') ? null : define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'] . DS);
		defined('BASE_URL') ? null : define('BASE_URL', 'http:' . DS . DS . $_SERVER['HTTP_HOST'] . DS);
		defined('DB_HOST') ? null : define('DB_HOST', 'localhost');
		defined('DB_USER') ? null : define('DB_USER', 'root');
		defined('DB_PSWD') ? null : define('DB_PSWD', '*1wAY2HvN');
		defined('DB_NAME') ? null : define('DB_NAME', 'imagematcher');
		break;
	default:
		break;
}

// Directory Structure
defined('APP_ROOT') ? null : define('APP_ROOT', ROOT_DIR . 'driver' . DS);
defined('MODS_DIR') ? null : define('MODS_DIR', APP_ROOT . 'modules' . DS);
defined('LIBS_DIR') ? null : define('LIBS_DIR', APP_ROOT . 'libraries' . DS);
defined('INCS_DIR') ? null : define('INCS_DIR', APP_ROOT . 'includes' . DS);

// App Namespace
defined('APP_NS') ? null : define('APP_NS', 'App');

// // Initialize Script Files
require_once LIBS_DIR . 'autoload.php';
loadLibs();
$db = new Database();
$session = new Session();

function pre_dump ($data) {
	echo '<pre>';
	var_dump($data);
	echo '</pre>';
}

?>