-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 27/01/2014 às 17:00
-- Versão do servidor: 5.5.35-0ubuntu0.13.10.1
-- Versão do PHP: 5.5.3-1ubuntu2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Estrutura para tabela `ab_grupos`
--

CREATE TABLE IF NOT EXISTS `ab_grupos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `sistema_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nome` (`nome`),
  KEY `sistema_id` (`sistema_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Fazendo dump de dados para tabela `ab_grupos`
--

INSERT INTO `ab_grupos` (`id`, `nome`, `sistema_id`) VALUES
(1, 'Admin', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ab_grupos_links_permissoes`
--

CREATE TABLE IF NOT EXISTS `ab_grupos_links_permissoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_id` int(11) NOT NULL,
  `link_id` int(11) NOT NULL,
  `permissao_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `grupo_id` (`grupo_id`,`link_id`,`permissao_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Fazendo dump de dados para tabela `ab_grupos_links_permissoes`
--

INSERT INTO `ab_grupos_links_permissoes` (`id`, `grupo_id`, `link_id`, `permissao_id`) VALUES
(1, 1, 2, 1),
(30, 1, 2, 2),
(29, 1, 2, 3),
(3, 1, 2, 4),
(6, 1, 3, 1),
(14, 1, 3, 2),
(16, 1, 3, 3),
(15, 1, 3, 4),
(7, 1, 4, 1),
(17, 1, 4, 2),
(18, 1, 4, 3),
(19, 1, 4, 4),
(8, 1, 5, 1),
(20, 1, 5, 2),
(12, 1, 5, 3),
(21, 1, 5, 4),
(28, 1, 5, 5),
(9, 1, 22, 1),
(22, 1, 22, 2),
(23, 1, 22, 3),
(24, 1, 22, 4),
(10, 1, 23, 1),
(25, 1, 23, 2),
(26, 1, 23, 3),
(27, 1, 23, 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ab_grupos_usuarios`
--

CREATE TABLE IF NOT EXISTS `ab_grupos_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `grupo_id` (`grupo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Fazendo dump de dados para tabela `ab_grupos_usuarios`
--

INSERT INTO `ab_grupos_usuarios` (`id`, `usuario_id`, `grupo_id`) VALUES
(1, 1, 1),
(2, 1, 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ab_links`
--

CREATE TABLE IF NOT EXISTS `ab_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL,
  `action` varchar(255) DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `plugin` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `orderby` int(11) DEFAULT NULL,
  `menu_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  KEY `parent_id` (`parent_id`),
  KEY `orderby` (`orderby`),
  KEY `controller` (`action`),
  KEY `action` (`controller`),
  KEY `plugin` (`plugin`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Fazendo dump de dados para tabela `ab_links`
--

INSERT INTO `ab_links` (`id`, `text`, `action`, `controller`, `plugin`, `icon`, `orderby`, `menu_id`, `parent_id`) VALUES
(1, 'Tabelas', NULL, NULL, '', 'application-list.png', 1, 1, NULL),
(2, 'Sistemas', 'index', 'ab_sistemas', 'ab', 'application.png', 1, 1, 1),
(3, 'Grupos', 'index', 'ab_grupos', 'ab', 'application.png', 2, 1, 1),
(4, 'Menus', 'index', 'ab_menus', 'ab', 'application.png', 3, 1, 1),
(5, 'Links', 'index', 'ab_links', 'ab', 'application.png', 4, 1, 1),
(21, 'Módulos', NULL, NULL, '', NULL, 2, 1, NULL),
(22, 'Usuários', 'index', 'ab_usuarios', 'ab', 'application.png', 1, 1, 21),
(23, 'Permissões', 'index', 'ab_permissoes', 'ab', NULL, 2, 1, 21);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ab_logins`
--

CREATE TABLE IF NOT EXISTS `ab_logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=708 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ab_menus`
--

CREATE TABLE IF NOT EXISTS `ab_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `orderby` varchar(255) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sistema_id` (`grupo_id`),
  KEY `ordem` (`orderby`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Fazendo dump de dados para tabela `ab_menus`
--

INSERT INTO `ab_menus` (`id`, `title`, `orderby`, `grupo_id`) VALUES
(1, 'Menu Superior', 'orderby', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ab_permissoes`
--

CREATE TABLE IF NOT EXISTS `ab_permissoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nome` (`nome`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Fazendo dump de dados para tabela `ab_permissoes`
--

INSERT INTO `ab_permissoes` (`id`, `nome`) VALUES
(2, 'Adicionar'),
(5, 'Adicionar Filho'),
(3, 'Editar'),
(4, 'Excluir'),
(1, 'Listar');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ab_sistemas`
--

CREATE TABLE IF NOT EXISTS `ab_sistemas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `icone` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`),
  KEY `nome` (`nome`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Fazendo dump de dados para tabela `ab_sistemas`
--

INSERT INTO `ab_sistemas` (`id`, `nome`, `url`, `icone`) VALUES
(1, 'Administration', 'http://login.vagr.com', 'icone1.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ab_usuarios`
--

CREATE TABLE IF NOT EXISTS `ab_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `senha` char(40) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `ativo` float NOT NULL DEFAULT '0',
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`),
  KEY `senha` (`senha`),
  KEY `ativo` (`ativo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Fazendo dump de dados para tabela `ab_usuarios`
--

INSERT INTO `ab_usuarios` (`id`, `usuario`, `senha`, `created`, `modified`, `ativo`, `nome`) VALUES
(1, 'authbootstrap', '1234567890', '2014-01-01 00:00:00', '2014-01-0 00:00:00', 1, 'Auth Bootstrap');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
