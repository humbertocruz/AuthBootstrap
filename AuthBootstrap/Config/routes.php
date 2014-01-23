<?php
// Autentica usuario pelo servidor de Login
Router::connect('/authenticate', array('plugin'=>'AuthBootstrap','controller' => 'usuarios', 'action' => 'authenticate'));
