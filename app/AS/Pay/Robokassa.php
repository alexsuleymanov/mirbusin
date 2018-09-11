<?php

class AS_Pay_Robokassa extends AS_Pay_Esystem
{
	private $client_id = "Mirbusin";
	private $login = "suleymanov";
	private $pass1 = "w50TkSL31VqBrAp0yjMV";
	private $pass2 = "S1jVMQwhT9peK9UnwS41";
	
	private $test_pass1 = "o1yhEBPZ3nMkFI69i5ri";
	private $test_pass2 = "bSJs7kfUGttj6090MHrk";
	
	public function pay($params)
	{
		$mrh_login = $this->client_id;
		$mrh_pass1 = $this->pass1;

		$inv_id = $params['SITE_ORDERNUMBER'];
		$inv_desc = $params['SITE_PRODDESCR'];
		$out_summ = $params['SITE_PAYAMOUNT'];

		$shp_item = 1;
		$in_curr = "RUB";
		$culture = "ru";
		$encoding = "utf-8";
		$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1");

		echo "<form action=\"https://auth.robokassa.ru/Merchant/Index.aspx\" method=\"post\">
			<input type=\"hidden\" name=\"MerchantLogin\" value=\"$mrh_login\" />
			<input type=\"hidden\" name=\"OutSum\" value=\"$out_summ\" />
			<input type=\"hidden\" name=\"InvId\" value=\"$inv_id\" />
			<input type=\"hidden\" name=\"Desc\" value=\"$inv_desc\" />
			<input type=\"hidden\" name=\"SignatureValue\" value=\"$crc\" />
			<input type=\"hidden\" name=\"IncCurrLabel\" value=\"BankCard\" />
		</form>";

		echo "<script type=\"text/javascript\">document.forms[0].submit();</script>";
		
//		print "<script language=JavaScript ".
//			"src='https://auth.robokassa.ru/Merchant/PaymentForm/FormMS.js?".
//			"MrchLogin=$mrh_login&OutSum=$out_summ&InvId=$inv_id&IncCurrLabel=$in_curr".
//			"&Desc=$inv_desc&SignatureValue=$crc".
//			"&IsTest=1&Culture=$culture&Encoding=$encoding'></script>";
	}

	public function is_success()
	{
		$mrh_login = $this->login;
		$out_summ = $_GET['OutSum'];
		$inv_id = $_GET['InvId'];
		$mrh_pass2 = $this->pass2;
		
		echo $_GET['SignatureValue'];
		echo "<br>";
		echo md5("$mrh_login:$inv_id:$mrh_pass2");
		die();
		return false;
	}
}
