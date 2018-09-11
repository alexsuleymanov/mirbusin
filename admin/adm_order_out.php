<?	$opt = Zend_Registry::get('opt');?>
<script type="text/javascript">
	function add_cart() {
		$("#add_to_cart").css("visibility", "visible");
	}

	function add_to_cart() {
		var art = $("#cart_art").val();
		var prodvar = $("#cart_var").val();
		location.href = '<?=$this->url->gvar("cart_action=buy")?>&prod_art='+art+'&prod_var='+prodvar;
	}
	
	function update_cart(id, obj) {
		var num = $(obj).val();
		location.href = '<?=$this->url->gvar("cart_action=update")?>&cart_id='+id+'&cart_num='+num;
	}
</script>

	<tr>
		<td class="edith" valign=top>Содержание заказа</td>
		<td class="edit">
			<a href="" onclick="add_cart(); return false;"><img src="<?=$this->path?>/img/add.jpg">Добавить</a><br><br>

			<div id="add_to_cart" style="visibility: hidden;">
				Введите артикул товара <input type="text" name="cart_art" id="cart_art" value="" /> и упаковку
				<select id="cart_var">
					<option name="1">1</option>
					<option name="2">2</option>
					<option name="3">3</option>
				</select>
				<button name="cart_add" onclick="add_to_cart(); return false;">Добавить</button>
				<br><br>
			</div>
			
			<table class="show" width="100%">
				<tr>
					<th class="show" width="2%">#</th>
					<th class="show">Товар</th>
					<th class="show" width="120">Фото</th>
					<th class="show" width="22%">Цена</th>
					<th class="show" width="22%">Количество</th>
					<th class="show" width="2%">&nbsp;</th>
				</tr>
			</table>
			<div id="carts">		
<?
	$Order = new Model_Order(0+$_GET[id]);
	$order = $Order->get(0+$_GET[id]);	
	$prods = $Order->getcart();
	$User = new Model_User('client');
	$user = $User->get($order->user);
	$order_total = $Order->total($order->user);
	
	$total_weight = 0;
	$userdiscount = 0;
	
	foreach($prods as $k => $r){
		$Prod = new Model_Prod($r['id']);
		$prod = $Prod->get();
		
		$inpack = $prod->inpack;
		$weight = $prod->weight;
		
		if($r['userdiscount']) $userdiscount = $r['userdiscount'];
			
		if($r['var'] == 2){
			$inpack = $prod->inpack2;
			$weight = $prod->weight2;
		}
		
		if($r['var'] == 3){
			$inpack = $prod->inpack3;
			$inpack = $prod->weight3;
		}
		
		$total_weight += $weight * $r['num'];
		$skidka = ($r['baseprice']) ? round((1-$r['price'] / $r['baseprice']), 2) * 100 : 0;
?>
			<table class="show" id="cart<?=$r->id?>" width="100%">
				<tr>
					<td class="show" width="2%"><?=++$j?></td>
					<td class="show" id="cart_title<?=$r['id']?>"><a href="adm_prod.php?action=edit&id=<?=$prod->id?>" target="_blank"><?=$prod->name?></a></td>
					<td class="show" width="120" align="center"><img id="cart_img<?=$r['id']?>" src="/pic/prod/<?=$prod->id?>.jpg" alt="" width="118" height="119"></td>
					<td class="show" width="22%"><?=($skidka > 0) ? "<s>".Func::fmtmoney($r['baseprice'])."</s> ".Func::fmtmoney($r['price']) : Func::fmtmoney($r['price'])?> р.<?=($skidka) ? "<br /><span style=\"color: red;\">Скидка: ".$skidka."%</span>" : ""?><br /><br />В упаковке: <?=$inpack?></td>
					<td class="show" width="22%"><input type='text' id="num" name='cart_num<?=$k?>' id="cart_num<?=$k?>" size="3" value="<?=$r['num']?>" onchange="update_cart('<?=$k?>', this)" /></td>
					<td class="show" width="2%" id="dela"><a href="<?=$this->url->gvar("cart_action=delete&cart_id=".$k)?>" id="a" onclick="remove_cart(<?=$k?>); return false;"><img src="<?=$this->path?>/img/b_del.png" alt="Del"></a></td>
				</tr>
			</table>
	<?}?>
				
	<div style="font-weight: bold">
		Стоимость: <font color="red"><?=Func::fmtmoney($Order->cart->amount())?></font> <?=$this->valuta['name']?><br/>
		Стоимость доставки: <font color="red"><?=Func::fmtmoney($order->deliverycost)?></font> <?=$this->valuta['name']?><br/>
		К оплате: <font color="red"><?=Func::fmtmoney($Order->cart->amount() + $order->deliverycost)?></font> <?=$this->valuta['name']?><br/><br/>
		Общая сумма заказов: <?=Func::fmtmoney($order_total)?> <?=$this->valuta['name']?><br/>
		Скидка: <?=$userdiscount?> %<br/>
		Общий вес: <?=$total_weight?> г<br/>
	</div>
	

</div>
