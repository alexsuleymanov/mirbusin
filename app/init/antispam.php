<?
	$ip = array(
//		"31.202.23.140",
		"69.162.124.228",
		"109.254.49.180",
		"178.158.82.126",
		"46.46.92.65",
		"69.162.124.228",
		"216.244.66.240",
	);
	
	if(in_array($_SERVER['REMOTE_ADDR'], $ip)){
		echo "<h1>С Вашего адреса зафиксирована подозрительная активность</h1>
			<p>Если Вы являетесь человеком, напишите нам - office@dombusin.com</p>
			<p>или позвоните (050) 760-40-98, (063) 473-10-64, (068) 080-68-70</p>";
			
		die();
	}
