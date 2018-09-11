<?php
$https = "http";
$host = "mirbusin.ru";
	
if($url->host != $host){ //www и https
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: $https://".$host.$_SERVER["REQUEST_URI"]);
	exit();
}

if ($url->page != 'cart/' && preg_match("/\/$/", $url->page)){ // По какой-то странной причине сайт делает редирект с /cart на /cart/, что дает бесконечный цикл
	$redir = substr($url->page, 0, strlen($url->page) - 1);
	if (!empty($url->query)) {
		$redir .= '?'.$url->query;
	}
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: /".$redir);
	exit();
}

$Redirect = new Model_Redirect();
$redirect = $Redirect->getone(array("where" => "oldurl = '".data_base::nq($_SERVER["REQUEST_URI"])."'"));

if($redirect->newurl){
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ".$redirect->newurl);
	exit();
}

if (isset($_GET['start']) && $_GET['start'] == 0) {
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: /".$url->page);
	exit();	
}
