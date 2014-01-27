**Autenticação, Permissões e Twitter Bootstrap**

*AuthBootstrap*

- Arquivos do Twitter Bootstrap
- Layout
- Helper para Formulários e Tabelas
- Servidor de Login
- Login / e Logout
- Menus - Gera informações em JSON dos menus do sistema requisitado pelo usuario
- Administração do Sistema de Autenticação - Permite manipular os dados dos sistemas, criar menus, links, usuarios e dar permissões aos grupos por sistema.

**Instalação**

Carregue o plugin necessários da seguinte forma:

```php
// Carrega o Plugin de Autenticação e Bootstrap
CakePlugin::load(
	array(
		'Ab' => array('bootstrap'=>true,'routes' => true)
	)
);
```
