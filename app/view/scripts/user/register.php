<?=$this->page->cont?>
<div class="col-sm-5">
    <?=$this->form?>
    <br class="ce-wide">
    <div class="clear"></div>
</div>
<div class="col-sm-1 blo-1">
    <div style="position: absolute; left: 5px; top: 70px; background: #fff;">или</div>
    <div style="height: 590px; border-right: 1px solid #ddd; width: 1px; margin: 2em 0 0;"></div>
</div>
<div class="col-sm-6">
	<div class="reg-auth--soc">
        <h5>Войти через социальные сети</h5>
        <div class="soc-list__btns">
            <?=$this->render('block/facebook/login-reg.php')?>
            <?=$this->render('block/google/login-reg.php')?>
        </div>

        <div class="reg-auth--soc--text">
            <p>Входя как пользователь социальной сети вы принимаете <a href="/polzovatelskoe-soglashenie">пользовательское соглашение</a> и политику конфиденциальности магазина.</p>
			<p>Если у вас уже есть учетная запись магазина, вы можете привязать к ней социальные сети в личном кабинете.</p>
        </div>
    </div>
</div>
<br class="ce-wide">
<div class="clear">&nbsp;</div>

