  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
  <script src="https://apis.google.com/js/api:client.js"></script>
  <script>
  var googleUser = {};
  var startApp = function() {
    gapi.load('auth2', function(){
      auth2 = gapi.auth2.init({
        client_id: '833593990050-1puvacml4823jnpsudpkktjjmbrcn7on.apps.googleusercontent.com',
        cookiepolicy: 'single_host_origin',
      });
      attachSignin(document.getElementById('bx_socserv_icon_GoogleOAuth'));
    });
  };

  function attachSignin(element) {
    console.log(element.id);
    auth2.attachClickHandler(element, {},
        function(googleUser) {
			var profile = googleUser.getBasicProfile();
			var id_token = googleUser.getAuthResponse().id_token;

			$.post('/auth/google', {"id": profile.getId(), "name": profile.getGivenName()+" "+profile.getFamilyName(), "email": profile.getEmail()}, function (data) {
				if (data == 'login' || data == 'register') {
					location.href = '<?=$this->url->mk("/user")?>';
				}
			});
        }, function(error) {
          alert(JSON.stringify(error, undefined, 2));
        });
  }
  </script>
  <style type="text/css">
    #customBtn {
      display: inline;
      background: transparent;
      color: #444;
      width: 150px;
      white-space: nowrap;
    }
    #customBtn:hover {
      cursor: pointer;
    }
    span.label {
      font-family: serif;
      font-weight: normal;
    }
  </style>
<?	if ($this->user->google_id) {?>
<a id="bx_socserv_icon_GoogleOAuth" class="soc-link soc-link__gp customGPlusSignIn" href="" onclick="if (confirm('Вы уверены, что хотите отвязать аккаунт?')) location.href = '/auth/google/unlink';">
  <span class="s-icon"><i class="icon-st__gp"></i></span>
  <span class="s-text">Привязан</span>
</a>
<?	} else { ?>	
<a id="bx_socserv_icon_GoogleOAuth" class="soc-link soc-link__gp customGPlusSignIn" href="javascript:void(0)" onclick="">
  <span class="s-icon"><i class="icon-st__gp"></i></span>
  <span class="s-text">Google+</span>
</a>
<?	}?>

<script>startApp();</script>
