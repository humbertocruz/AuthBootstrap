<?php
// Autentica usuario pelo servidor de Login
Router::connect('/authenticate', array('plugin'=>'AuthBootstrap','controller' => 'AuthBootstrap', 'action' => 'authenticate'));
Router::connect('/auth/authenticate', array('plugin'=>'AuthBootstrap','controller' => 'AuthBootstrap', 'action' => 'authenticate'));

// Rotas para o Plugin AuthLogin - Servidor de Login
// Autenticação
Router::connect('/login', array('plugin'=>'AuthBootstrap', 'controller' => 'Login', 'action' => 'login'));
// Desconectar
Router::connect('/logout', array('plugin'=>'AuthBootstrap', 'controller' => 'Login', 'action' => 'logout'));
// Gerar JSON com menus e usuario conectado
Router::connect('/menus', array('plugin'=>'AuthBootstrap', 'controller' => 'Login', 'action' => 'menus'));

