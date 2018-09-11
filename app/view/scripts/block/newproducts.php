<!-- Featured -->
<div class="title"><span>Новые поступления</span></div>
<?
$Prod = new Model_Prod();
$prods = $Prod->getall(array("where" => "visible = 1 and `new` = 1 and (num != 0 or num2 != 0 or num3 != 0)", "limit" => "8", "order" => "changed desc"));
$i = 0;
foreach ($prods as $prod) {?>
	<div class="col-sm-4 col-lg-3 box-product-outer prod-new">
		<div class="box-product">
			<div class="img-wrapper">
				<a href="/catalog/prod-<?= $prod->id ?>">
					<?if(file_exists('pic/prod/'.$prod->id.'.jpg')) {?>
						<img alt="<?= $prod->name ?>" src="/pic/prod/<?= $prod->id ?>.jpg">
					<?} else {?>
						<img alt="<?= $prod->name ?>" src="<?=$this->path?>/img/tr.gif">
					<?}?>
				</a>
			</div>
			<?/* if ($prod->pop) { ?>
				<div class="pc-hot"></div>
			<? }*/ ?>
			<? if ($prod->skidka) { ?>
				<div class="pc-skidka"><?="-".$prod->skidka."%" ?></div>
			<? } ?>
			<?	if($prod->new){?>
				<div class="pc-new"></div>
			<?	}?>
			<div class="h6"><a href="/catalog/prod-<?= $prod->id ?>"><?= $prod->name ?></a></div>
			<div class="price">
				<div>
					<?	$this->prodone = $this->prod;?>
					<?	echo $this->render('catalog/prod-price.php');?>
				</div>
			</div>
		</div>
	</div>
<? } ?>
<!-- End Featured -->
<div class="clearfix"></div>