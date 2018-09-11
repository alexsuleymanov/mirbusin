<script>
window.fbAsyncInit = function() {
	FB.init({
		appId      : '185496725434993',
		cookie     : true,                        
		xfbml      : true,
		version    : 'v2.8'
	});
};

(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
  
function ASwebFacebookLogin() {
	console.log('ASwebFacebookLogin');
	
	FB.api('/me', function(response) {
		$.post('/auth/facebook', {"id": response.id, "name": response.name}, function (data){
			if (data == 'login' || data == 'register'){
				location.href = '<?=$this->url->mk("/user")?>';
			}
		});
	});
}
</script>
<?	if ($this->user->facebook_id) {?>
<a id="bx_socserv_icon_Facebook" class="soc-link soc-link__fb" href="#" onclick="if (confirm('Вы уверены, что хотите отвязать аккаунт?')) location.href = '/auth/facebook/unlink';">
	<span class="s-icon"><i class="icon-st__fb"></i></span>
	<span class="s-text">Привязан</span>
</a>
<?	} else {?>
<a id="bx_socserv_icon_Facebook" class="soc-link soc-link__fb" href="javascript:void(0)" onclick="FB.login(function(response) {ASwebFacebookLogin();}, {scope: 'public_profile,email'});">
	<span class="s-icon"><i class="icon-st__fb"></i></span>
	<span class="s-text">Facebook</span>
</a>	
<?	}?>