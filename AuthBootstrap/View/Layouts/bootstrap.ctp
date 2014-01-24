<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php echo $this->Html->charset(); ?>
        <title>Admin - <?php echo $title_for_layout; ?></title>
        <?php
        echo $this->Html->meta( 'icon' );

        // jQuery
        echo $this->Html->script( 'http://code.jquery.com/jquery-2.0.3.min.js');

        // Bootstrap
        echo $this->Html->css( 'AuthBootstrap./bootstrap/css/bootstrap.min' );
        echo $this->Html->script( 'AuthBootstrap./bootstrap/js/bootstrap.min' );

        echo $this->fetch( 'meta' );
        echo $this->fetch( 'css' );
        echo $this->fetch( 'script' );

        // AuthBootstrap
        echo $this->Html->css('AuthBootstrap.authbootstrap.min');
        echo $this->Html->script( 'AuthBootstrap.authbootstrap' );
        ?>
    </head>
    <body>
        <?php 
            if ($this->Auth->loggedIn()) {
                echo $this->Element( 'AuthBootstrap.navbar-top' );
            }
        ?>
        <div class="container">
            <?php echo $this->Session->flash( 'flash', array( 'element'=>'AuthBootstrap.flash' ) ); ?>
        	<?php echo $this->fetch( 'content' ); ?>
        </div>
        <?php echo $this->element('sql_dump'); ?>
    </body>
</html>
