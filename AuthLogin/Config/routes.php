<?php
	// Rotas para o Plugin AuthLogin - Servidor de Login
	// Autenticação
	Router::connect('/login', array('plugin'=>'AuthLogin', 'controller' => 'AuthLLogin', 'action' => 'login'));
	// Desconectar
	Router::connect('/logout', array('plugin'=>'AuthLogin', 'controller' => 'AuthLLogin', 'action' => 'logout'));
	// Gerar JSON com menus e usuario conectado
	Router::connect('/menus', array('plugin'=>'AuthLogin', 'controller' => 'AuthLLogin', 'action' => 'menus'));

