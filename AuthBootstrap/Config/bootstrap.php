<?php
// AuthLogin
Configure::write('sistema_id','1');
Configure::write('menus_url','https://login.vagr.com/menus');
Configure::write('login_url', 'https://login.vagr.com/login');

// Converte Plural/Singular corretamente
include 'inflections.php';