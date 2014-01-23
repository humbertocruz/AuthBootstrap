<?php
	// Rotas para o Plugin AuthLogin - Servidor de Login
	// Autenticação
	Router::connect('/login', array('plugin'=>'AuthLogin', 'controller' => 'usuarios', 'action' => 'login'));
	// Desconectar
	Router::connect('/logout', array('plugin'=>'AuthLogin', 'controller' => 'usuarios', 'action' => 'logout'));
	// Gerar JSON com menus e usuario conectado
	Router::connect('/menus', array('plugin'=>'AuthLogin', 'controller' => 'usuarios', 'action' => 'menus'));

