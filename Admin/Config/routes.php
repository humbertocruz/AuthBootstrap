<?php
// Autentica usuario pelo servidor de Login
Router::connect('/authenticate', array('plugin'=>'Ab','controller' => 'AbAuthenticator', 'action' => 'authenticate'));
Router::connect('/Ab/Authenticator/authenticate', array('plugin'=>'Ab','controller' => 'AbAuthenticator', 'action' => 'authenticate'));

// Rotas para o Plugin AuthLogin - Servidor de Login
// Autenticação
Router::connect('/login', array('plugin'=>'Ab', 'controller' => 'AbLogins', 'action' => 'login'));
// Desconectar
Router::connect('/logout', array('plugin'=>'Ab', 'controller' => 'AbLogins', 'action' => 'logout'));
// Gerar JSON com menus e usuario conectado
Router::connect('/menus', array('plugin'=>'Ab', 'controller' => 'AbLogins', 'action' => 'menus'));

