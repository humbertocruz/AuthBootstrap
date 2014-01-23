<?php
// Autentica usuario pelo servidor de Login
Router::connect('/authenticate', array('plugin'=>'AuthBootstrap','controller' => 'auth', 'action' => 'authenticate'));
Router::connect('/auth/authenticate', array('plugin'=>'AuthBootstrap','controller' => 'auth', 'action' => 'authenticate'));
