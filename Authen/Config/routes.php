<?php
// Autentica usuario pelo servidor de Login
// Necessario para todos os Apps que vão utilizar a autenticação, mas não necessário no servidor de Login
Router::connect('/authenticate/*', 
	array('plugin'=>'Authen','controller' => 'Authenticator', 'action' => 'authenticate')
);

