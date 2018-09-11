<?
	class AS_Pay{
		public static function pay($order_sum){
			global $view, $sett, $labels;

			$esystem_id = ($_POST["esystem"]) ? $_POST["esystem"] : $_GET["esystem"];
			$order_id = ($_POST["order"]) ? $_POST["order"] : $_GET["order"];

			$Esystem = new Model_Esystem();
			$esystem = $Esystem->get($esystem_id);

			$params = array(
//				'SITE_REGION' => Zend_Registry::get('region_intname'),
				'SITE_LANG' => 'ru',
				'SITE_NAME' => $_SERVER['HTTP_HOST'],
				'SITE_ESYSTEM' => $esystem_id,
				'SITE_ORDERNUMBER' => $order_id,
				'SITE_PRODDESCR' => $labels["pay_for_bill"].$order_id,
				'SITE_PRODDESC_EN' => "Pay for order #".$order_id,
				'SITE_PAYAMOUNT' => Func::fmtmoney($order_sum * $esystem->course),
				'SITE_CURRENCY' => 'RUB',
				'ESYSTEM_CONT' => $esystem->cont,
			);

			if($esystem->form){
				header('Content-Type: text/html; charset=utf-8');
				$esystem->form = str_replace(array_keys($params), array_values($params), $esystem->form);
				echo $esystem->form;
				echo "<p align=\"center\"><img src=\"/app/view/img/loading.gif\" /></p>";
				echo "<script type=\"text/javascript\">document.forms[0].submit();</script>";
				die();
			}elseif($esystem->script){
//				header('Content-Type: text/html; charset=utf-8');
				$Pay = new $esystem->script();
				$Pay->pay($params);
			}else{
				$view->prod->cont = $esystem->cont;
				echo $layout->render($view);
			}
		}
		
		public static function is_success($order_id)
		{
			$Order = new Model_Order($order_id);
			$order = $Order->get($order_id);
			
			$Esystem = new Model_Esystem();
			$esystem = $Esystem->get($order->esystem);

			if ($esystem->script) {
				$Pay = new $esystem->script();
				return $Pay->is_success();
			}else{
				return false;
			}
		}
	}