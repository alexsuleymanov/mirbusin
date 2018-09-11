<?php
phpinfo();
die();
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    if (mail("alex.suleymanov@gmail.com", "Test mail", "Проверка отправки почты")) {
          echo "ok";
    } else {
           echo "error";		   
	}

//Func::mailhtml($_SERVER[HTTP_HOST], "noreply@".$_SERVER[HTTP_HOST], "alex.suleymanov@gmail.com", "Тестовое письмо", "Тест");
//mail("alex.suleymanov@gmail.com", "Test", "Test message");
//echo 'sent';
