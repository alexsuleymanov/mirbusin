<?
	error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
	ini_set("display_errors", 1);

	set_time_limit(0);

	header("Content-Type: text/html; charset=utf-8");
	include("adm_incl.php");

	function clear($str){
		return str_replace("\"\"", "\"", trim(iconv("windows-1251", "utf-8", $str), " \t\n\r\0\""));
	}

	function fmtmoney($str){
		return floatval(str_replace(",", ".", preg_replace("/[^\d|,]+/", "", $str)));
	}

	echo $view->render('head.php');

	if($_POST['submit']){
		$strings = ($_POST['full']) ? file($_FILES['ff3']['tmp_name']) : file($_FILES['ff']['tmp_name']);
		$User = new Model_User();
		foreach($strings as $k => $v){
			$r = explode(";", $v);

			$tstamp = clear($r['0']);
			$art = clear($r['1']);
			$name = clear($r['2']);
			$pic = clear($r['3']);
			$weight = clear($r['4']);
			$inpack = clear($r['5']);
						
			$data = array(
				"name" => clear($r['0']),
				"email" => clear($r['1']),
				"ordersum" => fmtmoney($r['2']),
				"opt" => clear($r['3']),
				"type" => "client",
				"created" => time(),
			);

			$User->insert($data);
//			$User->update($data, array("where" => "`email` = '".$data['email']."'"));
			print_r($data); echo "<br>";
			unset($strings[$k]);
		}
		echo "<br /><br /><a href=\"adm_import_1c2.php\">Назад</a>";
	}elseif($_POST['submit2']){
		$Prod = new Model_Prod();

		foreach($_FILES['ff2']['name'] as $k => $v){
			$prod = $Prod->getone(array("where" => "pic = '".$v."'"));
			if($prod->id){
				move_uploaded_file($_FILES['ff2']['tmp_name'][$k], $path."/pic/prod/".$prod->id.".jpg");
				copy($path."/pic/prod/".$prod->id.".jpg", $path."/pic/prodbig/".$prod->id.".jpg");
				$Watermark = new AS_Watermark($path."/pic/prod/".$prod->id.".jpg");
			    $Watermark->dst = $path."/pic/prod/".$prod->id.".jpg";
				$Watermark->add(2);
				
				echo $v." --- <a href=\"/pic/prod/".$prod->id.".jpg\" target=\"_blank\">/pic/prod/".$prod->id.".jpg</a><br>";
//				if($i % 20 == 0){
//				    echo str_repeat(' ',1024*64);
//				sleep(1);
//					flush();
//					ob_flush();
//				}
//				$outputcache->clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG, array("pic_prod_".$prod->id."_jpg"));
			}
		}

		echo "<br /><br /><a href=\"adm_import_1c.php\">Назад</a>";
		die();
	}elseif($_POST['submit4']){
		$Prod = new Model_Prod();
		$strings = file($_FILES['ff4']['tmp_name']);
		$j = 0;
		
		foreach($strings as $k => $v){
//			if($k < 1) continue;
			$r = explode(";", $v);
			$art = clear($r[0]);
			$skidka = clear($r[1]);
			$skidka2 = clear($r[2]);
			$skidka3 = clear($r[3]);

			if($_POST['opt']){
				$q .= "update dombusin_prod set `skidkaopt` = '".data_base::nq($skidka)."', `skidkaopt2` = '".data_base::nq($skidka2)."', `skidkaopt3` = '".data_base::nq($skidka3)."' where `art` = '".data_base::nq($art)."'; ";				
			}else{
				$q .= "update dombusin_prod set `skidka` = '".data_base::nq($skidka)."', `skidka2` = '".data_base::nq($skidka2)."', `skidka3` = '".data_base::nq($skidka3)."' where `art` = '".data_base::nq($art)."'; ";
			}
	//		echo $q; die();
			if($j++ % 50 == 0){
				echo str_repeat(' ',1024*64);
				flush();
				ob_flush();
				$Prod->mq($q);
				echo $q;
				$q = "";				
			}
			echo $art."| - ".$skidka."<br />";
//			$Prod->update(array('skidka' => $skidka), array("where" => "art = '".data_base::nq($r[0])."'"));
		}
		if($q){
			echo str_repeat(' ',1024*64);
			flush();
			ob_flush();
			$Prod->mq($q);
//			echo $q;
			$q = "";							
		}
		
		$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG, array("model_prod"));
		echo "Импорт завершен. ".$j." позиций";
		echo "<br /><br /><a href=\"adm_import_1c.php\">Назад</a>";
		die();
	}elseif($_POST['submit6']){
		$Prod = new Model_Prod();
		$strings = file($_FILES['ff5']['tmp_name']);
		$j = 0;
		
		foreach($strings as $k => $v){
//			if($k < 1) continue;

			$r = explode(";", $v);
			$art = clear($r[0]);
			$numdiscount = clear($r[1]);
			$numdiscount2 = clear($r[2]);
			$numdiscount3 = clear($r[3]);

			if($_POST['opt']){
				$q .= "update dombusin_prod set `numdiscountopt` = '".data_base::nq($numdiscount)."', `numdiscountopt2` = '".data_base::nq($numdiscount2)."', `numdiscountopt3` = '".data_base::nq($numdiscount3)."' where `art` = '".data_base::nq($art)."'; ";
				//if($numdiscount2) $q .= "update dombusin_prod set `numdiscountopt2` = '".data_base::nq($numdiscount2)."' where `art` = '".data_base::nq($art)."'; ";
				//if($numdiscount3) $q .= "update dombusin_prod set `numdiscountopt3` = '".data_base::nq($numdiscount3)."' where `art` = '".data_base::nq($art)."'; ";
			}else{
				$q .= "update dombusin_prod set `numdiscount` = '".data_base::nq($numdiscount)."', `numdiscount2` = '".data_base::nq($numdiscount2)."', `numdiscount3` = '".data_base::nq($numdiscount3)."' where `art` = '".data_base::nq($art)."'; ";
				//if($numdiscount2) $q .= "update dombusin_prod set `numdiscount2` = '".data_base::nq($numdiscount2)."' where `art` = '".data_base::nq($art)."'; ";
				//if($numdiscount3) $q .= "update dombusin_prod set `numdiscount3` = '".data_base::nq($numdiscount3)."' where `art` = '".data_base::nq($art)."'; ";
			}
	//		echo $q; die();
			if($j++ % 50 == 0){
				echo str_repeat(' ',1024*64);
				flush();
				ob_flush();
				$Prod->mq($q);
				echo $q;
				$q = "";				
			}
			echo $art."| - ".$numdiscount."-".$numdiscountopt."<br />";
//			$Prod->update(array('skidka' => $skidka), array("where" => "art = '".data_base::nq($r[0])."'"));
		}
		if($q){
			echo str_repeat(' ',1024*64);
			flush();
			ob_flush();
			$Prod->mq($q);
//			echo $q;
			$q = "";							
		}
		
		$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG, array("model_prod"));
		echo "Импорт завершен. ".$j." позиций";
		echo "<br /><br /><a href=\"adm_import_1c.php\">Назад</a>";
		die();
	}elseif($_POST['submit5']){
		$Prod = new Model_Prod();
		$prods = $Prod->getall(array("where" => "art like '% %'"));
		foreach($prods as $prod){
			$q .= "update dombusin_prod set `art` = '".trim($prod->art)."' where id = ".$prod->id."; ";
			if($j++ % 50 == 0){
				echo str_repeat(' ',1024*64);
				flush();
				ob_flush();
				$Prod->mq($q);
				$q = "";
			}
			echo $prod->id." - ".$prod->art."<br />";
			
		}
	}elseif($_POST['submit7']){
		$Prod = new Model_Prod();
		$strings = file($_FILES['ff4']['tmp_name']);
		$j = 0;
		
		foreach($strings as $k => $v){
			if($k < 0) continue;

			$r = explode(";", $v);
			$art = clear($r[0]);
			$pop = clear($r[1]);
			$mix = clear($r[1]);
			$new = clear($r[1]);
			
			if ($_POST['mix'] == 1) {
				$q .= "update dombusin_prod set `mix` = '".data_base::nq($mix)."' where `art` = '".data_base::nq($art)."'; ";
			} elseif ($_POST['new'] == 1) {
				$q .= "update dombusin_prod set `new` = '".data_base::nq($new)."' where `art` = '".data_base::nq($art)."'; ";				
			}else {
				$q .= "update dombusin_prod set `pop` = '".data_base::nq($pop)."' where `art` = '".data_base::nq($art)."'; ";
			}

	//		echo $q; die();
			if($j++ % 50 == 0){
				echo str_repeat(' ',1024*64);
				flush();
				ob_flush();
				$Prod->mq($q);
				echo $q;
				$q = "";				
			}
			echo $art."<br />";
//			$Prod->update(array('skidka' => $skidka), array("where" => "art = '".data_base::nq($r[0])."'"));
		}
		if($q){
			echo str_repeat(' ',1024*64);
			flush();
			ob_flush();
			$Prod->mq($q);
//			echo $q;
			$q = "";						
		}
		
		$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG, array("model_prod"));
		echo "Импорт завершен. ".$j." позиций";
		echo "<br /><br /><a href=\"adm_import_1c.php\">Назад</a>";
		die();
	}else{?>
<div style="margin: 20px;">
<h2>Обновление пользователей</h2>
<form action="" method="post" enctype="multipart/form-data">
	<input type="file" name="ff" />
	<input type="submit" name="submit" value="Импортировать" />
</form>
</div>
<?	}

	echo $view->render('foot.php');