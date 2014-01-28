<?php
// Autentica usuario pelo servidor de Login
// Necessario para todos os Apps que vão utilizar a autenticação, mas não necessário no servidor de Login
Router::connect('/authenticate', array('plugin'=>'Login','controller' => 'Authenticator', 'action' => 'authenticate'));

// Rotas para o Plugin AuthBootstrap - Servidor de Login
// Autenticação
Router::connect('/login', array('plugin'=>'Login', 'controller' => 'Logins', 'action' => 'login'));
// Desconectar
Router::connect('/logout', array('plugin'=>'Login', 'controller' => 'Logins', 'action' => 'logout'));
// Gerar JSON com menus e usuario conectado
Router::connect('/menus', array('plugin'=>'Login', 'controller' => 'Logins', 'action' => 'menus'));

