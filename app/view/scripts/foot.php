		</div>
	</div>
</div>
<!-- End Main Content -->

<!-- Footer -->
<div class="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-6">
				<div class="title-footer"><span>О нас</span></div>
				<ul>
					<li><i class="fa fa-angle-double-right"></i> <a href="<?=$this->url->mk('/about')?>">О магазине</a></li>
					<li><i class="fa fa-angle-double-right"></i> <a href="<?=$this->url->mk('/optovim-pokupatelyam')?>">Оптовым покупателям</a></li>
					<li><i class="fa fa-angle-double-right"></i> <a href="<?=$this->url->mk('/delivery')?>">Доставка и оплата</a></li>
				</ul>
			</div>
			<div class="col-md-3 col-sm-6">
				<div class="title-footer"><span>Выгодные предложения</span></div>
				<ul>
					<li><i class="fa fa-angle-double-right"></i> <a href="<?=$this->url->mk('/catalog/action')?>">Акции</a></li>
				</ul>
			</div>
			<div class="col-md-3 col-sm-6">
				<div class="title-footer"><span>С нами можно связаться</span></div>
				<ul>
					<li><i class="fa fa-angle-double-right"></i> <a href="<?=$this->url->mk('/contact')?>">Контакты</a></li>
				</ul>
			</div>
			<div class="col-md-3 col-sm-6">
				<div class="title-footer"><span>Оцените нас</span></div>
				<ul>
					<li><i class="fa fa-angle-double-right"></i> <a href="<?=$this->url->mk('/comments')?>">Отзывы</a></li>
				</ul>
			</div>

		</div>
	</div>
	<div class="text-center copyright">
		Copyright © 2014-2018 Мир бусин
		<div class="footer-space"></div>


<?/*	<script type="text/javascript">
!function(t,e,c,n){var s=e.createElement©;s.async=1,s.src="https://script.softcube.com/"+n+"/sc.js";var r=e.scripts[0];r.parentNode.insertBefore(s,r)}(window,document,'script',"CF0B9A5F1A134785B046327D17152863");
</script>*/?>
	
		<?	if($this->args[0] == 'order' && $this->args[1] == 'finish'){?>
			<!-- Google Code for https://www.dombusin.com/ Conversion Page -->
			<script type="text/javascript">
	        /* <![CDATA[ */
	        var google_conversion_id = 973438294;
	        var google_conversion_language = "en";
	        var google_conversion_format = "3";
	        var google_conversion_color = "ffffff";
	        var google_conversion_label = "k8dOCK3ioWcQ1vqV0AM";
	        var google_remarketing_only = false;
	        /* ]]> */
	        </script>
	        <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
	        </script>
	        <noscript>
	        <div style="display:inline;">
	        <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/973438294/?label=k8dOCK3ioWcQ1vqV0AM&amp;guid=ON&amp;script=0"/>
	        </div>
	        </noscript>
		<?	}?>

	</div>
</div>
<!-- End Footer -->
<a href="#top" class="back-top text-center" onclick="$('body,html').animate({scrollTop:0},500); return false">
	<i class="fa fa-angle-up"></i>
</a>

<?=$this->render('block/modal_callback.php')?>
<?=$this->render('block/modal_sent.php')?>

<?=$this->render('block/razmetka.php')?>
</body>
</html>