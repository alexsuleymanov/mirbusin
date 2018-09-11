<?php

class Pay_Robokassa extends Pay_Esystem
{
	private $client_id = "Mirbusin2020";
	private $login = "suleymanov";
	private $pass1 = "w50TkSL31VqBrAp0yjMV";
	private $pass2 = "S1jVMQwhT9peK9UnwS41";
	
	private $test_pass1 = "o1yhEBPZ3nMkFI69i5ri";
	private $test_pass2 = "bSJs7kfUGttj6090MHrk";
	
	public function pay($params)
	{
		$mrh_login = $this->login;
		$mrh_pass1 = $this->pass1;

		$inv_id = $params['SITE_ORDERNUMBER'];
		$inv_desc = $params['SITE_PRODDESCR'];
		$out_summ = $params['SITE_PAYAMOUNT'];

		$shp_item = 1;
		$in_curr = "";
		$culture = "ru";
		$encoding = "utf-8";
		$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item");

		print "<html><script language=JavaScript ".
			"src='https://auth.robokassa.ru/Merchant/PaymentForm/FormFLS.js?".
			"MrchLogin=$mrh_login&OutSum=$out_summ&InvId=$inv_id&IncCurrLabel=$in_curr".
			"&Desc=$inv_desc&SignatureValue=$crc&Shp_item=$shp_item".
			"&Culture=$culture&Encoding=$encoding'></script></html>";
	}

	public function is_success()
	{
		return false;
	}
}
