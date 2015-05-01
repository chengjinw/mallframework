<?php
if (!defined('DEBUG')) {
    define('DEBUG', false);
}
error_reporting(E_ALL);
ini_set('display_errors', '1');

define('SYS_ROOT', __DIR__ . DIRECTORY_SEPARATOR);
define('FRAMEWORK_ROOT', SYS_ROOT . 'Framework' . DIRECTORY_SEPARATOR);

define('DS',DIRECTORY_SEPARATOR);
define('SITE_URL','http://womall.com');


require_once FRAMEWORK_ROOT . 'Lib/Autoloader.php';
Core\Lib\Autoloader::loadAll();

$pathMap = array(
	0               => 'Mall/Home/index',
    '/i/home/index' => 'Mall/Home/index',
    '/Admin/index'  => 'Admin/Admin/adminList',
    '/Store/index'  => 'Store/Admin/index',
);

$_config['default_action'] = 'index';


//框架公用，快捷函数

if(file_exists(FRAMEWORK_ROOT.'/Common.php')){
	require_once(FRAMEWORK_ROOT.'/Common.php');
}

require_once(FRAMEWORK_ROOT . 'Main.php');
\Core\Main::instance()->init($pathMap)->run();