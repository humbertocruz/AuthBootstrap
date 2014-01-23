<html>
<body>
<form class="form-autosubmit" action="<?php echo $login_url;?>" method="post">
	<input type="hidden" id="fld-usuario" name="usuario" value="<?php echo urlencode( $usuario ); ?>">
	<input type="hidden" id="fld-menus" name="menus" value="<?php echo urlencode( $menus ); ?>">
</form>
</body>
</html>
