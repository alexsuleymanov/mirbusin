<ul>
	<?
	$Prod = new Model_Prod();
	$prods = $Prod->getall(array("where" => "visible = 1 and `changed` > ".(time() - 45*86400)." and (num != 0 or num2 != 0 or num3 != 0)", "limit" => "8", "order" => "changed desc"));
	$i = 0;
	foreach ($prods as $prod) {?>
		<?if($i++%4==0){?>
			<div class="line clearfix">
		<?}?>
				<div class="tovar-l clearfix" id="tovar-img<?=$prod->id?>">
					<div class="tovar-img">
						<a href="/catalog/prod-<?= $prod->id ?>">
							<img src="/pic/prod/<?= $prod->id ?>.jpg" width="180" alt="<?= $prod->name ?>" id="prodpreview<?=$prod->id?>">
						</a>
<?		if ($prod->skidka) { ?>
						<div class="discount"><span>-<?= $prod->skidka ?>%</span></div>
<?		} ?>
<?		if($prod->pop){?>
						<div class="hot"></div>
<?		}?>

					</div>
					<p><a href="/catalog/prod-<?= $prod->id ?>" title="<?=$prod->name?>"><?=Func::fmtname($prod->name)?></a></p>
					<?if(!$_COOKIE['useropt'] && $_COOKIE['userdiscount']) { ?>
						<span style="font-size: 14px;"><s><?= Func::fmtmoney($prod->price) ?>&nbsp;<?=$this->valuta['name']?> / <?= $prod->inpack ?>&nbsp;</s></span>
						<span><span style="color:red; font-weight: bold; font-size: 14px;"><?= Func::fmtmoney($prod->price*(100-$_COOKIE['userdiscount'])/100) ?>&nbsp;<?=$this->valuta['name']?></span> / <?= $prod->inpack ?>&nbsp;</span>
					<?	}else{?>
					<span style="font-size: 14px;"><?= Func::fmtmoney($prod->price * (100-$prod->skidka)/100) ?>&nbsp;<?=$this->valuta['name']?> / <?= $prod->inpack ?></span>
					<?	}?>
					<span>
						<form action="<?=$this->url->gvar("buy=1")?>" method="post" id="prodform_<?=$prod->id?>">
							<input type="hidden" name="id" value="<?=$prod->id?>" />
							<input type="hidden" name="ajax" value="1" class="ajax" />
							<input type="hidden" name="fromurl" value="<?=$_SERVER['REQUEST_URI'].$this->url->gvar(time()."=")?>" class="prod_id" />
							<input type="image" src="<?=$this->path?>/img/bbuy.png" onclick="_gaq.push(['_trackEvent', 'Buy', 'Click_buy', 'Buy']); buy(<?=$prod->id?>); return false;" style="margin: 0 0 0 20px;">
							<input type="text" maxlength="5" name="num" id="quantity<?=$prod->id?>" value="1" onchange="check_num(<?=$prod->id?>, $('#prodvar<?=$prod->id?>').val(), $(this).val());">
						</form>
					</span>
				</div>
		<?if($i%4==0){?>
			</div>
		<?}?>
	<? } ?>
	<?if($i%4!=0){?>
		</div>
	<?}?>
</ul>
