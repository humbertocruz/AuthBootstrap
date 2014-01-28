<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php echo $this->Html->charset(); ?>
		<title>Admin - <?php echo $title_for_layout; ?></title>
		<?php
		echo $this->Html->meta( 'icon' );

		// jQuery
		echo $this->Html->script( 'Ab./bootstrap/jquery-2.1.0.min.js');

		// Bootstrap
		echo $this->Html->css( 'Ab./bootstrap/css/bootstrap.min' );
		echo $this->Html->script( 'Ab./bootstrap/js/bootstrap.min' );

		echo $this->fetch( 'meta' );
		echo $this->fetch( 'css' );
		echo $this->fetch( 'script' );

		// AuthBootstrap
		echo $this->Html->css('Ab.authbootstrap.min');
		echo $this->Html->script( 'Ab.authbootstrap' );
		?>
	</head>
	<body>
		<?php 
			if (isset($menus)) {
				echo $this->Element( 'Ab.navbar-top-admin' ); 
			}
		?>
		<div class="container">
			<?php if (isset( $init_password ) ) { ?>
			<div class="alert alert-danger">
				<h4>Senha Inicial para o usuario "bootstrap"</h4>
				<?php echo $init_password; ?>
			</div>
			<?php } ?>
			<?php echo $this->Session->flash( 'flash', array( 'element'=>'Ab.flash' ) ); ?>
			<?php echo $this->fetch( 'content' ); ?>
		</div>
		<?php echo $this->element('sql_dump'); ?>
	</body>
</html>
