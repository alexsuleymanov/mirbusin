<?php	
	error_reporting(E_ALL & ~E_NOTICE);
	ini_set("display_errors", 1);

	set_include_path(implode(PATH_SEPARATOR, array(realpath(dirname(__FILE__)), realpath(dirname(__FILE__)."/app"), ".")));
	date_default_timezone_set("Europe/Kiev");
//	Global Vars
	$path = realpath(dirname(__FILE__));
	ini_set('session.save_path', $path.'/sessions/');
//	$https = $_SERVER['HTTPS'] == 'on' ? : 
//	/Global Vars

	ini_set("magic_quotes_gpc", 0);
	ini_set("magic_quotes_runtime", 0);

	require_once "Zend/Loader/Autoloader.php";

	$autoloader = Zend_Loader_Autoloader::getInstance();
	$autoloader->registerNamespace('Model_');
	$autoloader->registerNamespace('Form_');
	$autoloader->registerNamespace('Pay_');
	$autoloader->registerNamespace('AS_');

	Zend_Session::start();
	
	require_once "init/antispam.php";
	require_once "lib/Func.php";
	require_once "lib/db.php";
	require_once "lib/URLParser.php";
	require_once "lib/imageresizer.php";

	require_once "conn.php";
	require_once "init/cache.php";
	require_once "init/system-scripts.php";
	require_once "init/opt.php";
	require_once "init/sett.php";

	