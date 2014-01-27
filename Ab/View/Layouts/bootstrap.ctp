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
                echo $this->Element( 'Ab.navbar-top' ); 
            }
        ?>
        <div class="container">
            <?php echo $this->Session->flash( 'flash', array( 'element'=>'Ab.flash' ) ); ?>
        	<?php echo $this->fetch( 'content' ); ?>
        </div>
        <?php echo $this->element('sql_dump'); ?>
    </body>
</html>
