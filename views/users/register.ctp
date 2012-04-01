<?php 

?>

<script type="text/javascript">
	$(document).ready(function() {	
		$( "input:submit", "#RegisterForm").button();
	});	
</script>

	<div style="padding:10px;">
	<form action="/users/register" id="RegisterForm" method="post" accept-charset="utf-8">
		<div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
		<div style="margin:4px;"><span style="padding:2px;">Username:</span><input type="text" name="data[User][username]" id="UserUsername" /></div>
		<div style="margin:4px;"><span style="padding:2px;">Password:</span><input type="password" name="data[User][password]" id="UserPassword" /></div>
		<div style="margin:4px;"><span style="padding:2px;">Confirm:</span><input type="password" name="data[User][password_confirm]" id="UserPasswordConfirm" /></div>
		<div class="submit"><input type="submit" value="Register"></div>
	</form>	
	</div>