<div style="position: absolute; top: -5000px; height: 1px; overflow: hidden;">

<div xmlns:v="http://rdf.data-vocabulary.org/#" typeof="v:Organization">
    <span property="v:name" content="Интернет магазин Mirbusin.ru"></span>
    <div rel="v:address">
        <div typeof="v:Address">
            <span property="v:street-address" content="г. Москва, ул. Подольская, д. 1, оф.199"></span>
        </div>
    </div>
    <span property="v:tel" content="8-800-555-10-57"></span>
    <span property="v:tel" content="+7-495-215-28-15"></span>
    <span property="v:url" content="https://mirbusin.ru/"></span>
</div>


<script type="application/ld+json"> 
    {
        "@context": "http://schema.org/",
        "@type": "HobbyShop",
        "name": "Мир бусин",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "ул. Подольская, 1",
            "addressLocality": "Москва",   
            "addressRegion": "",   
            "postalCode": "109651"  
        },  
        "image": "https://mirbusin.ru/app/view/img/logo.jpg",  
        "email": "office@mirbusin.com", 
        "telephone": "8-800-555-10-57",  
        "url": "https://mirbusin.ru/",  
        "paymentAccepted": [ "cash", "credit card" ],  
        "openingHours": "Mo,Tu,We,Th,Fr,Sa,Su 00:00-23:59",  
        "geo": {   
            "@type": "GeoCoordinates",   
            "latitude": "55.654683",   
            "longitude": "37.712429"  
        },  
        "priceRange": "$" 
    } 
</script>

<?if($this->args[0] == 'catalog' && $this->cat && empty($this->prod)){
	$minprice = MAX_VALUE;
	$maxprice = 0;
	//print_r($this->prods);
	foreach($this->prods as $k => $v){
		if($v->price && $v->price < $minprice) $minprice = $v->price;
		if($v->price2 && $v->price2 < $minprice) $minprice = $v->price2;
		if($v->price3 && $v->price3 < $minprice) $minprice = $v->price3;
		if($v->price && $v->price > $maxprice) $maxprice = $v->price;
		if($v->price2 && $v->price2 > $maxprice) $maxprice = $v->price2;
		if($v->price3 && $v->price3 > $maxprice) $maxprice = $v->price3;
	}
	?>
<div itemscope itemtype="https://schema.org/Product">
	<p itemprop="Name"><?=$this->page->h1?></p>
	<div itemtype="https://schema.org/AggregateOffer" itemscope="" itemprop="offers">
	<meta content="<?=$this->cnt?>" itemprop="offerCount">
	<meta content="<?=Func::fmtmoney($maxprice)?>" itemprop="highPrice">
	<meta content="<?=Func::fmtmoney($minprice)?>" itemprop="lowPrice">
	<meta content="RUB" itemprop="priceCurrency">
	</div>
</div>
<?}?>
	
<?if($this->args[0] == 'catalog' && $this->prod){?>

<div itemscope itemtype="https://schema.org/Product">
<span itemprop="name"><?=$this->prod->name?></span>
<img src="/pic/prod/<?=$this->prod->id?>.jpg" />
 
<div itemprop="offers" itemscope itemtype="https://schema.org/Offer">
<span itemprop="priceCurrency" content="RUB">руб.</span>
<span itemprop="price" content="<?=Func::fmtmoney($this->prod->price)?>"><?=Func::fmtmoney($this->prod->price)?></span>
<link itemprop="availability" href="https://schema.org/InStock" />
</div>
 
<span itemprop="description"><?=$this->page->descr?></span>

<?	if(!empty($this->comments)){?>
<div itemprop="review" itemscope itemtype="https://schema.org/Review">
<?		foreach($this->comments as $k => $v){?>
	<span itemprop="name">Отзыв</span>
	от <span itemprop="author"><?=$v->author?></span>,
	<meta itemprop="datePublished" content="<?=date("Y-m-d", $v->tstamp)?>">
	<span itemprop="description"><?=$v->cont?></span>
<?		}?>
</div>
<?	}?>
</div>
<?	}?>
	
<script type="application/ld+json">
{"@context": "https://schema.org", "@type": "BreadcrumbList", "itemListElement":
  [
<?	
	$i = 0;
	$cou = count($this->bc);

foreach($this->bc as $l => $t){?>
  {"@type": "ListItem", "position": <?=($i+1)?>, "item": {"@id": "<?=$l?>", "name": "<?=$t?>"}}<?if($i++ < $cou-1) echo ",\n";?>
<?	}?>
  ]
}
</script>

</div>