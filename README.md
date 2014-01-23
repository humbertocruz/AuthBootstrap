
**Autenticação, Permissões e Twitter Bootstrap**

* AuthBootstrap *

- Arquivos do Twitter Bootstrap
- Layout
- Helper para Formulários e Tabelas

* AuthLogin *

- Servidor de Login
- Login / e Logout
- Menus - Gera menus do sistema requisitado pelo usuario

* AuthAdmin *

Administração do Sistema de Autenticação - Permite manipular os dados dos sistemas, criar menus, links, usuarios e dar
permissões aos grupos por sistema.

* Instalação *

Configure os plugins necessários da seguinte forma:

```php
// Carrega o Plugin de Autenticação e Bootstrap
CakePlugin::load(
	array(
		'AuthBootstrap' => array('bootstrap'=>true,'routes' => true),
		'AuthAdmin'  => array('bootstrap' => true),
		'AuthLogin' => array('routes' => true)
	)
);
```
