<?
include("adm_incl.php");

$dir = opendir($path."/tmp");
while ($ff = readdir($dir)) {
	if($ff == '.' || $ff == '..') continue;
	if (file_exists($path."/tmp/".$ff)) unlink($path."/tmp/".$ff);
}
closedir($dir);
	
$dir = opendir($path."/tmpimg");
while ($ff = readdir($dir)) {
	if ($ff == '.' || $ff == '..') continue;
	if (file_exists($path."/tmpimg/".$ff)) unlink($path."/tmpimg/".$ff);
}
closedir($dir);

echo $view->render('head.php');
echo "<h3>Кеш очищен</h3>";
echo $view->render('foot.php');