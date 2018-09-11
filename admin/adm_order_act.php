<?
$del = 0 + $_GET['del'];
$add = 0 + $_GET['add'];
$vid = 0 + $_GET['id'];
$export = 0 + $_GET['export'];
$export2 = 0 + $_GET['export2'];
$edit_cart = 0 + $_GET['edit_cart'];

$cart_action = $_GET['cart_action'];
	
if ($del){
	$Cart = new Model_Cart();
	$Cart->delete(array("where" => "id = '$del'"));
	echo $del;
	die();
}

if ($add){
	$Cart = new Model_Cart();
	$Cart->insert(array("order" => $vid));
	echo $Cart->last_id();
	die();
}

if ($export){
	$Order = new Model_Order();
	$Order->export_csv($vid);
	die();
}

if ($_GET['action'] == 'mass_export'){
	$Order = new Model_Order();
	$Order->mass_export_csv($_POST['del']);
	die();
}
	
if ($export2){
	$Order = new Model_Order();
	$Order->export_csv2($vid);
	die();
}

if ($edit_cart){
	$Cart = new Model_Cart($_GET['cart_id']);
	$Prod = new Model_Prod($_GET['prod']);
	$prod = $Prod->get();
		
	$data = array(
		'id' => $_GET['cart_id'],
		'order' => $_GET['order'],
		'prod' => $prod->id,
		'price' => $prod->price,
		'num' => 1,
		'skidka' => $prod->skidka,
	);

	$Cart->save($data);

	Zend_Json::encode($data);
	die();
}

if($_GET['update_cart']){
	$Cart = new Model_Cart($_GET['cart_id']);
	$Cart->save(array("num" => $_GET['num']));
	die();
}

if ($_GET['change_user']) {
	if($_GET['user_email']){
		$Order = new Model_Order($_GET['order_id']);
		$User = new Model_User("client");
		$user = $User->getone(array("where" => "email = '".data_base::nq($_GET['user_email'])."'"));
		$Order->save(array("user" => $user->id));
		$url->redir($url->gvar("order_id=&change_user=&user_id="));
		die();
	}else{
		echo $view->render('head.php');
		echo "<form action='".$url->gvar("time=")."' method='get'><input type='hidden' name='order_id' value='".$_GET['order_id']."'><input type='hidden' name='change_user' value='1'>E-mail пользователя: <input type=\"text\" name=\"user_email\"> <input type='submit' value='Сменить'></form>";
		echo $view->render('foot.php');
	}
	die();
}
	
$Order = new Model_Order($_GET['id']);
$order = $Order->get($_GET['id']);

$Cart = new Model_Cart(0, $order->id);
$Cart->setPath($path);

if ($cart_action == 'buy') {
	$prod_art = $_GET['prod_art'];
	$var = $_GET['prod_var'];
	$num = 1;

	$Prod = new Model_Prod();
	$prod = $Prod->getone(array("where" => "`art` = '".data_base::nq($prod_art)."'"));

	$price = $prod->price;
	$skidka = $prod->skidka;
	$weight = $prod->weight;
	$numdiscount = $prod->numdiscount;
		
	if ($var == 2) {
		$price = $prod->price2;
		$skidka = $prod->skidka2;
		$weight = $prod->weight2;
		$numdiscount = $prod->numdiscount2;
	}
	
	if ($var == 3) {
		$price = $prod->price3;
		$skidka = $prod->skidka3;
		$weight = $prod->weight3;
		$numdiscount = $prod->numdiscount3;
	}
	
	$Cart->buy($prod->id, $var, $num, $price, $skidka, $numdiscount, $weight);
	$Cart->save_cart_admin($order->id);
	
	$url->redir($url->gvar("cart_action=&prod_var=&prod_art="));
	die();
} elseif ($cart_action == 'update') {
	$cart_id = $_GET["cart_id"];
	$num = $_GET["cart_num"] ? $_GET["cart_num"] : 1;

	$Prod = new Model_Prod();
	$prod = $Prod->get($Cart->cart[$cart_id]['id']);
	$var = $Cart->cart[$cart_id]['var'];
	
	$weight = $prod->weight;
	
	$numdiscount = $prod->numdiscount;
		
	if ($var == 2) {
		$numdiscount = $prod->numdiscount2;
	}
	
	if ($var == 3) {
		$numdiscount = $prod->numdiscount3;
	}

	$Cart->update_cart($cart_id, $num, $numdiscount);
	$Cart->save_cart_admin($order->id);
	
	$url->redir($url->gvar("cart_action=&cart_id=&cart_num="));
	die();
} elseif ($cart_action == 'delete') {
	$cart_id = $_GET['cart_id'];
	
	$Cart->delete_cartitem($cart_id);
	$Cart->save_cart_admin($order->id);
	
	$url->redir($url->gvar("cart_action=&cart_id=&cart_num="));
	die();
}