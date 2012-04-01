 <style type="text/css">
	.button {
		display: inline-block;
		margin:2px;
	}
 </style>
 
	<script type="text/javascript">
			$(document).ready(function() {	
				$( "input:submit", "#UserLoginForm").button();
				
				$("#registerButton")
				.button()
				.click(
					function(e) {
						window.location.href = "/users/register";
					}
				);
			});

	</script>

	<?php
		echo $this->Session->flash('auth');
	?>	
	
	<div style="padding:10px;">
	<form action="/users/login" id="UserLoginForm" method="post" accept-charset="utf-8">
		<div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
		<div style="margin:4px;"><span style="padding:2px;">Username:</span><input type="text" name="data[User][username]" id="UserUsername" /></div>
		<div style="margin:4px;"><span style="padding:2px;">Password:</span><input type="password" name="data[User][password]" id="UserPassword" /></div>
		<div class="button"><input type="submit" value="Login"></div><div class="button"><input id="registerButton" type="button" value="Register"></div>

	</form>	
	</div>