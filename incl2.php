<?php
	if (defined('ASWEB_ADMIN')) {
		require_once "init/templates.php";	
	}
	
	if (!defined('ASWEB_ADMIN') && (!empty($args) && !in_array($args[0].".php", $minimal_scripts))){
		require_once "init/redirect.php";
		require_once "init/noindex-scripts.php";
		require_once "init/labels.php";
		require_once "init/blocks.php";
		require_once "init/templates.php";
		require_once "init/valuta.php";
		require_once "init/history.php";

//		require_once "init/compare.php";
		require_once "init/user.php";
		require_once "init/cart.php";
	}