**Autenticação, Permissões e Twitter Bootstrap**

*AuthBootstrap*

- Arquivos do Twitter Bootstrap
- Layout
- Helper para Formulários e Tabelas
- Servidor de Login / Permissões e Logout
- Administração do Sistema de Autenticação - Permite manipular os dados dos sistemas, criar menus, links, usuarios e dar permissões aos grupos por sistema.
- Menus - Gera informações em JSON dos menus do sistema requisitado pelo usuario

**Instalação**

Carregue o plugin da seguinte forma no arquivo Config/bootstrap.php:

```php
// Carrega o Plugin de Autenticação e Bootstrap
CakePlugin::load(
	array(
		'Ab' => array('bootstrap'=>true,'routes' => true)
	)
);
```

Altere a Home da sua aplicação no Config/routes.php:
```php
Router::connect('/', array('plugin'=>'Ab','controller' => 'AbUsuarios', 'action' => 'home' ));
```

** Tabelas **
