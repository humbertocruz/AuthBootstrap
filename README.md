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
Configure o AuthBootstrap
```php
Configure::write('sistema_id','2');
Configure::write('menus_url','http://login.vagr.com/menus');
Configure::write('login_url', 'http://login.vagr.com/login');
```

Altere a Home da sua aplicação no Config/routes.php:
```php
Router::connect('/', array('plugin'=>'Ab','controller' => 'AbUsuarios', 'action' => 'home' ));
```

Acesse a base de dados e altere a senha do usuario "bootstrap" para a senha que aparece na tela inicial do sistema (gerada a partir do hash no seu servidor). A senha padrão será "authbootstrap" ( sem aspas ).

Edite o arquivo Plugins/Ab/Controllers/AbAppController.php e comente a linha 42 para remover a mensagem sobre a senha inicial.

**Login**
usuario: authbootstrap
senha: authbootstrap


** Tabelas **
