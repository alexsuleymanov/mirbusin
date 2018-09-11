<?//print_r($_SESSION);?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/favicon.ico" type="image/x-icon">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title><?= ($this->page->title) ? $this->page->title : $this->sett['sitename'] . ". " . $this->page->name ?></title>
	<meta name="description" content="<?= $this->page->descr ?>">
	<meta name="keywords" content="<?= $this->page->kw ?>">

<?	if($this->cnt && $this->results && $this->start > 0){
		if(strpos($_SERVER["REQUEST_URI"], "?")) $diff = 2;
		$str = substr($_SERVER["REQUEST_URI"], 1, strlen($_SERVER["REQUEST_URI"]) - strlen($_SERVER["QUERY_STRING"])-$diff);

		$prev = ($this->start-$this->results == 0) ? "" : $this->start-$this->results;?>
	<link rel="prev" href="/<?=$str.$this->url->gvar("start=".$prev)?>" />
<?	}?>
<?	if($this->cnt && $this->results && $this->start < ($this->cnt - $this->results)){
		if(strpos($_SERVER["REQUEST_URI"], "?")) $diff = 2;
		$str = substr($_SERVER["REQUEST_URI"], 1, strlen($_SERVER["REQUEST_URI"]) - strlen($_SERVER["QUERY_STRING"])-$diff);
?>
	<link rel="next" href="/<?=$str.$this->url->gvar("start=".($this->start+$this->results))?>" />
<?	}?>
		
	<!-- Bootstrap -->
	<link href="<?=$this->path?>/mimity/bootstrap/css/bootstrap.css" rel="stylesheet">
	<!-- Plugins -->

	<link href="<?=$this->path?>/mimity/css/font-awesome.css" rel="stylesheet">
	<link href="<?=$this->path?>/mimity/css/bootstrap-select.css" rel="stylesheet">
	<link href="<?=$this->path?>/mimity/css/nouislider.css" rel="stylesheet">
	<link href="<?=$this->path?>/mimity/css/owl.carousel.css" rel="stylesheet">
	<link href="<?=$this->path?>/mimity/css/owl.theme.default.css" rel="stylesheet">
	<link href="<?=$this->path?>/mimity/css/jquery.bootstrap-touchspin.css" rel="stylesheet">
	<link href="<?=$this->path?>/mimity/css/style.teal.flat.css" rel="stylesheet" id="theme">
	<link href="<?=$this->path?>/css/jquery.slinky.css?v3" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="<?=$this->path?>/mimity/js/jquery.min.js"></script>
	<script src="<?=$this->path?>/js/jquery-migrate-1.4.1.js"></script>

	<link rel="stylesheet" type="text/css" href="<?= $this->path ?>/js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
	<script type="text/javascript" src="<?= $this->path ?>/js/fancybox/jquery.mousewheel-3.0.4.pack.js" async="1"></script>
	<script type="text/javascript" src="<?= $this->path ?>/js/fancybox/jquery.fancybox-1.3.4.pack.js" async="1"></script>

	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?=$this->path?>/mimity/bootstrap/js/bootstrap.js"></script>
	<!-- Plugins -->
	<script src="<?=$this->path?>/mimity/js/bootstrap-select.js"></script>
	<script src="<?=$this->path?>/mimity/js/nouislider.js"></script>
	<script src="<?=$this->path?>/mimity/js/owl.carousel.min.js"></script>
	<script src="<?=$this->path?>/mimity/js/jquery.ez-plus.js"></script>
	<script src="<?=$this->path?>/mimity/js/jquery.bootstrap-touchspin.js"></script>
	<script src="<?=$this->path?>/mimity/js/jquery.raty-fa.js"></script>
	<script src="<?=$this->path?>/mimity/js/mimity.js"></script>
	<script src="<?=$this->path?>/mimity/js/mimity.detail.js"></script>
	<script src="<?=$this->path?>/js/jquery.slinky.js"></script>
	<script type="text/javascript" src="<?= $this->path ?>/js/msgwindo.js" async="1"></script>
<?/*	<script type="text/javascript" src="<?= $this->path ?>/js/noty/packaged/jquery.noty.packaged.min.js"></script>
	<script type="text/javascript" src="<?= $this->path ?>/js/noty/layouts/topCenter.js"></script>*/?>
	<script type="text/javascript" src="<?= $this->path ?>/js/jquery.countdown.min.js"></script>
	<script src="<?= $this->path ?>/js/jquery.maskedinput.min.js" type="text/javascript"></script>
	<script src="<?= $this->path ?>/js/blazy.min.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="<?= $this->path ?>/js/cart.js" async="1"></script>
	<script type="text/javascript" src="<?= $this->path ?>/js/init.js" async="1"></script>
	<?/*	if(strip_tags($this->blocks['user_message'])){?>
	<script type="text/javascript">
		$(document).ready(function(){
			noty({
				text: '<?=strip_tags($this->blocks['user_message'])?>',
				type: 'warning',
				layout: 'topCenter',
				theme: 'relax'
			}).show();
		});
	</script>
	<?	}*/?>
	<?= $this->sett['meta'] ?>

	<link href="<?= $this->path ?>/css/asform.css" rel="stylesheet" type="text/css" />
	<link href="<?= $this->path ?>/mimity/css/custom.css" rel="stylesheet" type="text/css" />

<?	if($this->canonical){?>
	<link rel="canonical" href="https://mirbusin.ru<?=$this->canonical?>"/>
<?	}?>

<?	if($this->noindex){?>
	<meta name='robots' content='noindex, nofollow' />
<?	}?>
<?	if ($this->args[0] == 'order' && $this->args[1] == 'finish') {?>	
	<script>
		window.dataLayer = window.dataLayer || []
		dataLayer.push({
			'transactionId': '<?=$this->order_id?>',
			'transactionTotal': <?=Func::fmtmoney($this->order_sum)?>,
			'transactionProducts': [
<?	$cii = 0;
	foreach($this->cartitems as $item) {
		$Prod = new Model_Prod($item['id']);
		$prod = $Prod->get();		
		$cat = $Prod->getcat();
		if ($cii++ > 0) echo ",";
?>
			{
				'sku': '<?=$prod->art?>',
				'name': '<?=$prod->name?>',
				'category': '<?=$cat->name?>',
				'price': <?=Func::fmtmoney($item['price'])?>,
				'quantity': <?=$item['num']?>
			}
<?	}?>			
			]
		});
</script>
<?	}?>
	<meta name="google-site-verification" content="s72PJFFwzku-8W4EZbw8mN4YqtzudCAqnnRXEtsdMvE" />
	<meta name="yandex-verification" content="e281049a4d711d98" />

	<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PPVMLH5');</script>
<!-- End Google Tag Manager -->

	<script charset="UTF-8" src="//cdn.sendpulse.com/js/push/1029ba693ba3aa725455cd24a782a403_1.js" async></script>
</head>
<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PPVMLH5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?
if ($_SESSION['message']) {?>
<script>
	alert('<?=$_SESSION['message']?>');
</script>
<?	unset($_SESSION['message']);
}?>
<div id="prod_added">
	<div class="added-message">Товар добавлен<br>в корзину</div>
</div>
<div id="prod_added2">
	<div class="added-message">Товар добавлен<br>в список желаний</div>
</div>
<div id="loading">
	<img src="/pic/loading.gif" alt="">
</div>

<span id="ScMail" style="display: none;"><?=$_SESSION['useremail']?></span>
<?
$Timer = new Model_Timer();
$timer = $Timer->getone(array('where' => 'visible=1 and end > '.time(), 'order' => 'rand()'));
if($timer->id) {
?>
	<div class="top-action" style="background: url('/pic/timerbg/<?=$timer->id?>.jpg')">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-xs-12 ta-1"><a href="<?=$timer->href?>"><img src="/pic/timer/<?=$timer->id?>.jpg" alt=""></a></div>
				<div class="col-md-4 col-xs-12 ta-2"><div id="timer"></div></div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function() {
			$('#timer').countdown('<?=date("Y/m/d H:i:s", $timer->end)?>', function (event) {
				$(this).html(event.strftime('%D дней %H:%M:%S'));
			});
		});
	</script>
<?}?>

<!-- Top Header -->
<div class="top-header">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<ul class="list-inline pull-right">
					<? if (Model_User::userid()) { ?>
						<li><a href="<?= $this->url->mk("/user") ?>" id="login_link"><?= $this->labels["welcome"] ?>, <?= $_SESSION["username"] ?></a></li><li><a href="/user/wishlist">Список желаний</a></li><li><a href="/login/logoff">Выход</a></li>
					<? } else { ?>
					<li>
						<div class="dropdown">
							<button class="btn dropdown-toggle" type="button" id="dropdownLogin" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								Вход в интернет магазин <span class="caret"></span>
							</button>
							<div class="dropdown-menu dropdown-menu-left dropdown-menu-login" aria-labelledby="dropdownLogin" data-dropdown-in="zoomIn" data-dropdown-out="fadeOut">
								<?=$this->render('block/login.php')?>
							</div>
						</div>
					</li>
						<li>
							<div class="dropdown">
								<button class="btn dropdown-toggle" type="button" id="dropdownRegister" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" onclick="location.href='/register'">
									Регистрация<!-- <span class="caret"></span>-->
								</button>
								<?/*?>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-login" aria-labelledby="dropdownRegister" data-dropdown-in="zoomIn" data-dropdown-out="fadeOut">
									<?=$this->render('block/register.php')?>
								</div>
								<?*/?>
							</div>
						</li>
					<? } ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- End Top Header -->

<!-- Middle Header -->
<div class="middle-header">
	<div class="container">
		<div class="row">
			<div class="col-md-3 logo">
				<a href="<?=$this->url->mk('/')?>"><img alt="Logo" src="<?=$this->path?>/img/logo.png" class="img-responsive" /></a>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-3 search-box m-t-2">
				<form name="search" action="<?= $this->url->mk("/search") ?>" method="get" class="input-group" id="topsearch">
					<input type="text" name="q" id="keywords" class="form-control search" aria-label="Поиск..." placeholder="Поиск..." onkeypress="
					$('#keywords').removeClass('emptysearch');
					">
					<div class="input-group-btn">
						<button type="button" class="btn btn-default btn-search" onclick="
						if($('#keywords').val()) {
							$('#topsearch').submit();
						} else {
							$('#keywords').addClass('emptysearch');
						}"><i class="fa fa-search"></i></button>
					</div>
				</form>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-3 top-phones-block">
				<a href="#" rel="nofollow" class="top-phone"><i class="fa fa-phone"></i>
					<span>8-800</span>-555-10-57
				</a>
				<a data-toggle="modal" href="#modal_callback" rel="nofollow" class="top-phone top-phone-2">
					Обратный звонок
				</a>
			</div>
			<div class="col-sm-4 col-md-3 cart-btn hidden-xs m-t-2">
				<?=$this->render('cart/block.php')?>
			</div>
		</div>
	</div>
</div>
<!-- End Middle Header -->

<!-- Navigation Bar -->
<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="/cart" class="btn btn-default btn-cart-xs visible-xs pull-right">
				<i class="fa fa-shopping-cart"></i>&nbsp;&nbsp; Ваша корзина
			</a>
			<div class="logo">
				<a href="<?=$this->url->mk('/')?>"><img alt="Logo" src="<?=$this->path?>/img/logo.jpg" class="img-responsive" /></a>
			</div>
		</div>
		<div class="collapse navbar-collapse" id="navbar-ex1-collapse">
			<?= $this->render('block/menu.php') ?>
		</div>
	</div>
</nav>
<!-- End Navigation Bar -->

<!-- Main Content -->
<div class="container m-t-3">
	<div class="row">
		<? if (($this->args[0] != 'cart') && ($this->args[0] != 'register') && ($this->args[0] != 'order') && (!( ($this->args[0] == 'user') && ($this->args[1] == 'order-history') && (is_numeric($this->args[2])) )) && (!( ($this->args[0] == 'user') && ($this->args[1] == 'order-history') && ($this->args[2] == 'last') )) && (!( ($this->args[0] == 'user') && ($this->args[1] == 'wishlist') ))) { ?>

			<!-- Filter Sidebar -->
			<div class="col-sm-3 left-desktop-menu">
				<? if ($this->args[0] == 'user') { ?>
					<div class="head_mod"><p>Мой аккаунт</p></div>
					<?= $this->render('user/head.php') ?>
				<? } elseif (((count($this->prods))||($_GET['filter']==1))&&($this->cat)) { ?>

					<?
					$opt = Zend_Registry::get('opt');
					//	par == 1  Основные параметры
					//	par == 2  Расширенные параметры
					//  par == 3  Все параметры

					$par = 0 + $this->params;
					$cat = 0 + $this->cat;

					$chars = array();
					if ($opt["prod_chars"]) {
						$Char = new Model_Char();
						if ($par == 1 || $par == 0)
							$chars = $Char->getall(array("where" => Model_Cat::cat_tree($cat) . " and search = '1'", "order" => "prior desc"));
						else if ($par == 2)
							$chars = $Char->getall(array("where" => Model_Cat::cat_tree($cat) . " and (search = '1' or search = '2')", "order" => "prior desc"));
						else
							$chars = $Char->getall(array("where" => Model_Cat::cat_tree($cat) . " and (search = '1' or search = '2' or search = '3')", "order" => "prior desc"));
					}

					if (count($chars)) {
						$this->chars_count = count($chars);
						?>
						<div class="filter-sidebar">
							<div class="title">
								<span class="left-switcher" onmouseover="
								$('.left-switcher').removeClass('left-switcher-active');
								$(this).addClass('left-switcher-active');
								$('.left-tab').css('display', 'none');
								$('#left-tab-1').css('display', 'block');
								">Категории</span>
								<span class="left-switcher left-switcher-active" onmouseover="
								$('.left-switcher').removeClass('left-switcher-active');
								$(this).addClass('left-switcher-active');
								$('.left-tab').css('display', 'none');
								$('#left-tab-2').css('display', 'block');
								">Фильтр</span>
								<div class="clear"></div>
							</div>
						</div>

						<?echo $this->render('block/catmenu.php');//if(!$this->outputcache->start('catmenu')) {echo $this->render('block/catmenu.php'); $this->outputcache->end();}?>
						<?echo $this->render('block/extsearch.php');//if(!$this->outputcache->start('extsearch'.$this->cat)) {echo $this->render('block/extsearch.php'); $this->outputcache->end();}?>
					<? } else {
						$this->chars_count = count($chars);?>
						<div class="filter-sidebar">
							<div class="title"><span>
									<?if($this->args[1]==='new') {?>
										Категории новинок
									<?}elseif($this->args[1]==='pop') {?>
										Категории популярных
									<?}elseif($this->args[1]==='action') {?>
										Категории акций
									<?} else {?>
										Категории товаров
									<?}?></span>
							</div>
						</div>
							<?echo $this->render('block/catmenu.php');//if(!$this->outputcache->start('catmenua')) {echo $this->render('block/catmenu.php'); $this->outputcache->end();}?>

					<? } ?>


				<? } else { ?>
						<div class="filter-sidebar">
							<div class="title"><span>
								<?if($this->args[1]==='new') {?>
									Категории новинок
								<?}elseif($this->args[1]==='pop') {?>
									Категории популярных
								<?}elseif($this->args[1]==='action') {?>
									Категории акций
								<?} else {?>
									Категории товаров
								<?}?>
							</div>
						</div>
						<?echo $this->render('block/catmenu.php');//if(!$this->outputcache->start('catmenua')) {echo $this->render('block/catmenu.php'); $this->outputcache->end();}?>

				<? } ?>
			</div>
		<!-- End Filter Sidebar -->

		<!-- Product List -->
		<div class="col-sm-9 cont">

		<? } else {?>
			<div class="col-sm-12 cont">
		<?}?>

		<?if(($this->args[0]=='user')&&($this->args[1]=='wishlist')) {?>
			<div class="title<?=$this->prods?' pl-breadcrumbs':''?>"><span>Список желаний</span></div>
		<?} elseif($this->args[0] != 'cart') {?>
			<div class="title<?=$this->prods?' pl-breadcrumbs':''?>"><span><?=$this->render('block/breadcrumbs.php')?></span></div>
		<?}?>



			<? if ($this->args[0] == '') { ?>
				<!-- Full Slider -->
				<div class="container-fluid">
					<div class="row">
						<div class="home-slider">
							<?
							$Banner = new Model_Banner();
							$banners = $Banner->getall(array("where" => "`position` = 1"));
							
							foreach ($banners as $banner) {
								?>
								<div class="item">
									<?= $banner->cont ?>
								</div>
							<? } ?>
						</div>
					</div>
				</div>
				<!-- End Full Slider -->

				<?= $this->render('block/recomended-cats.php') ?>
				<div class="ce-wide main-np">
				<?= $this->render('block/newproducts.php') ?>
				</div>
				<?= $this->render('block/m-cats.php') ?>


			<? } ?>