<?php
Router::parseExtensions('json');
// Rotas para o Plugin AuthBootstrap - Servidor de Login
// Autenticação
Router::connect('/login', array('plugin'=>'Server', 'controller' => 'Logins', 'action' => 'login'));
// Desconectar
Router::connect('/logout', array('plugin'=>'Server', 'controller' => 'Logins', 'action' => 'logout'));
// Gerar JSON com menus e usuario conectado
Router::connect('/menus', array('plugin'=>'Server', 'controller' => 'Logins', 'action' => 'menus'));

