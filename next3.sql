-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.30-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para next3
CREATE DATABASE IF NOT EXISTS `next3` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `next3`;

-- Copiando estrutura para tabela next3.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_title` varchar(255) DEFAULT NULL,
  `category_slug` varchar(255) DEFAULT NULL,
  `category_color` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela next3.categories: ~0 rows (aproximadamente)
DELETE FROM `categories`;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Copiando estrutura para tabela next3.emails
CREATE TABLE IF NOT EXISTS `emails` (
  `email_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email_name` varchar(80) COLLATE utf8_bin NOT NULL,
  `email_email` varchar(80) COLLATE utf8_bin NOT NULL,
  `email_phone` varchar(50) COLLATE utf8_bin NOT NULL,
  `email_subject` varchar(50) COLLATE utf8_bin NOT NULL,
  `email_message` mediumtext COLLATE utf8_bin NOT NULL,
  `email_category` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela next3.emails: ~0 rows (aproximadamente)
DELETE FROM `emails`;
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;

-- Copiando estrutura para tabela next3.galleries
CREATE TABLE IF NOT EXISTS `galleries` (
  `gallery_id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_title` varchar(80) NOT NULL,
  `gallery_slug` varchar(80) NOT NULL,
  PRIMARY KEY (`gallery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela next3.galleries: ~0 rows (aproximadamente)
DELETE FROM `galleries`;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;

-- Copiando estrutura para tabela next3.galleries_img
CREATE TABLE IF NOT EXISTS `galleries_img` (
  `galleryimg_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_gallery` int(11) NOT NULL,
  `galleryimg_title` varchar(80) NOT NULL,
  `galleryimg_link` longtext,
  `galleryimg_file` varchar(255) NOT NULL,
  `galleryimg_order` int(11) NOT NULL,
  PRIMARY KEY (`galleryimg_id`),
  KEY `fk_gallery` (`fk_gallery`),
  CONSTRAINT `fk_gallery` FOREIGN KEY (`fk_gallery`) REFERENCES `galleries` (`gallery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela next3.galleries_img: ~0 rows (aproximadamente)
DELETE FROM `galleries_img`;
/*!40000 ALTER TABLE `galleries_img` DISABLE KEYS */;
/*!40000 ALTER TABLE `galleries_img` ENABLE KEYS */;

-- Copiando estrutura para tabela next3.log
CREATE TABLE IF NOT EXISTS `log` (
  `log_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `log_date` datetime NOT NULL,
  `log_ip` varchar(60) NOT NULL,
  `log_name` varchar(255) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela next3.log: ~0 rows (aproximadamente)
DELETE FROM `log`;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;

-- Copiando estrutura para tabela next3.media
CREATE TABLE IF NOT EXISTS `media` (
  `media_id` int(11) NOT NULL AUTO_INCREMENT,
  `media_title` varchar(80) NOT NULL,
  `media_file` varchar(255) NOT NULL,
  PRIMARY KEY (`media_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela next3.media: ~0 rows (aproximadamente)
DELETE FROM `media`;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;

-- Copiando estrutura para tabela next3.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_category` int(11) NOT NULL,
  `post_active` enum('y','n') NOT NULL DEFAULT 'y',
  `post_title` varchar(255) DEFAULT NULL,
  `post_slug` varchar(255) DEFAULT NULL,
  `post_desc` varchar(255) DEFAULT NULL,
  `post_content` longtext NOT NULL,
  `post_file` varchar(255) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela next3.posts: ~0 rows (aproximadamente)
DELETE FROM `posts`;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- Copiando estrutura para tabela next3.role_permissions
CREATE TABLE IF NOT EXISTS `role_permissions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Lft` int(11) NOT NULL,
  `Rght` int(11) NOT NULL,
  `Title` char(64) COLLATE utf8_bin NOT NULL,
  `Description` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Title` (`Title`),
  KEY `Lft` (`Lft`),
  KEY `Rght` (`Rght`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela next3.role_permissions: ~18 rows (aproximadamente)
DELETE FROM `role_permissions`;
/*!40000 ALTER TABLE `role_permissions` DISABLE KEYS */;
INSERT INTO `role_permissions` (`ID`, `Lft`, `Rght`, `Title`, `Description`) VALUES
	(1, 0, 35, 'root', 'root'),
	(2, 1, 6, 'gallery_delete', 'Can delete gallery items'),
	(3, 2, 5, 'gallery_edit', 'Can edit gallery items'),
	(4, 3, 4, 'gallery_view', 'Can view gallery items'),
	(5, 7, 12, 'media_delete', 'Can delete media library items'),
	(6, 8, 11, 'media_edit', 'Can edit media library items'),
	(7, 9, 10, 'media_view', 'Can view media library items'),
	(8, 13, 18, 'post_delete', 'Can delete posts'),
	(9, 14, 17, 'post_edit', 'Can edit posts'),
	(10, 15, 16, 'post_view', 'Can view posts'),
	(11, 19, 24, 'user_delete', 'Can delete users'),
	(12, 20, 23, 'user_edit', 'Can edit users'),
	(13, 21, 22, 'user_view', 'Can view users'),
	(14, 25, 30, 'settings_delete', 'Can delete settings'),
	(15, 26, 29, 'settings_edit', 'Can edit settings'),
	(16, 27, 28, 'settings_view', 'Can view settings'),
	(17, 31, 32, 'mail_view', 'Can view mail messages'),
	(18, 33, 34, 'home_view', 'Can view homepage');
/*!40000 ALTER TABLE `role_permissions` ENABLE KEYS */;

-- Copiando estrutura para tabela next3.role_rolepermissions
CREATE TABLE IF NOT EXISTS `role_rolepermissions` (
  `RoleID` int(11) NOT NULL,
  `PermissionID` int(11) NOT NULL,
  `AssignmentDate` int(11) NOT NULL,
  PRIMARY KEY (`RoleID`,`PermissionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela next3.role_rolepermissions: ~22 rows (aproximadamente)
DELETE FROM `role_rolepermissions`;
/*!40000 ALTER TABLE `role_rolepermissions` DISABLE KEYS */;
INSERT INTO `role_rolepermissions` (`RoleID`, `PermissionID`, `AssignmentDate`) VALUES
	(1, 1, 1517226741),
	(1, 18, 1517334441),
	(2, 2, 1517226850),
	(2, 5, 1517226850),
	(2, 8, 1517226850),
	(2, 11, 1517226850),
	(2, 14, 1517226850),
	(2, 17, 1517226850),
	(2, 18, 1517334441),
	(3, 3, 1517226902),
	(3, 6, 1519129387),
	(3, 7, 1517226902),
	(3, 9, 1519129403),
	(3, 12, 1517226902),
	(3, 15, 1517226903),
	(3, 17, 1517226903),
	(3, 18, 1517334441),
	(4, 4, 1517226929),
	(4, 7, 1517226929),
	(4, 10, 1517226929),
	(4, 13, 1517226929),
	(4, 18, 1517334441);
/*!40000 ALTER TABLE `role_rolepermissions` ENABLE KEYS */;

-- Copiando estrutura para tabela next3.role_roles
CREATE TABLE IF NOT EXISTS `role_roles` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Lft` int(11) NOT NULL,
  `Rght` int(11) NOT NULL,
  `Title` varchar(128) COLLATE utf8_bin NOT NULL,
  `Description` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Title` (`Title`),
  KEY `Lft` (`Lft`),
  KEY `Rght` (`Rght`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela next3.role_roles: ~4 rows (aproximadamente)
DELETE FROM `role_roles`;
/*!40000 ALTER TABLE `role_roles` DISABLE KEYS */;
INSERT INTO `role_roles` (`ID`, `Lft`, `Rght`, `Title`, `Description`) VALUES
	(1, 0, 7, 'root', 'root'),
	(2, 1, 6, 'administrador', 'Administrador do site'),
	(3, 2, 5, 'editor', 'Editor do site'),
	(4, 3, 4, 'colaborador', 'Colaborador do site');
/*!40000 ALTER TABLE `role_roles` ENABLE KEYS */;

-- Copiando estrutura para tabela next3.role_userroles
CREATE TABLE IF NOT EXISTS `role_userroles` (
  `UserID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL,
  `AssignmentDate` int(11) NOT NULL,
  PRIMARY KEY (`UserID`,`RoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela next3.role_userroles: ~4 rows (aproximadamente)
DELETE FROM `role_userroles`;
/*!40000 ALTER TABLE `role_userroles` DISABLE KEYS */;
INSERT INTO `role_userroles` (`UserID`, `RoleID`, `AssignmentDate`) VALUES
	(1, 1, 1517227016),
	(2, 2, 1517227016),
	(3, 3, 1517227016),
	(4, 4, 1517227016);
/*!40000 ALTER TABLE `role_userroles` ENABLE KEYS */;

-- Copiando estrutura para tabela next3.sections
CREATE TABLE IF NOT EXISTS `sections` (
  `id_section` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `section_title` varchar(80) NOT NULL DEFAULT '0',
  `section_slug` varchar(80) NOT NULL DEFAULT '0',
  `section_icon` varchar(20) NOT NULL DEFAULT '0',
  `section_order` int(11) unsigned NOT NULL DEFAULT '0',
  `section_sub` enum('y','n') NOT NULL DEFAULT 'n',
  `section_menu` enum('y','n') NOT NULL DEFAULT 'y',
  `section_perm` varchar(50) NOT NULL,
  PRIMARY KEY (`id_section`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela next3.sections: ~8 rows (aproximadamente)
DELETE FROM `sections`;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` (`id_section`, `section_title`, `section_slug`, `section_icon`, `section_order`, `section_sub`, `section_menu`, `section_perm`) VALUES
	(1, 'Página Inicial', 'home', 'fa-home', 1, 'n', 'y', 'user_view'),
	(2, 'Galeria de Banners', 'gallery', 'fa-tv', 2, 'n', 'y', 'gallery_view'),
	(3, 'Publicações', 'post', 'fa-edit', 4, 'y', 'y', 'post_view'),
	(4, 'E-mails', 'emails', 'fa-envelope', 6, 'n', 'y', 'mail_view'),
	(5, 'Configurações', 'settings', 'fa-cogs', 8, 'y', 'y', 'settings_edit'),
	(6, 'Biblioteca de mídia', 'media', 'fa-image', 3, 'n', 'y', 'media_view'),
	(7, 'Categorias', 'category', 'fa-tags', 5, 'n', 'n', 'post_view'),
	(8, 'Usuários', 'user', 'fa-users', 7, 'n', 'y', 'user_view');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;

-- Copiando estrutura para tabela next3.sections_sub
CREATE TABLE IF NOT EXISTS `sections_sub` (
  `id_sub` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_section` int(11) unsigned NOT NULL,
  `sub_title` varchar(80) NOT NULL,
  `sub_slug` varchar(30) NOT NULL,
  `sub_icon` varchar(20) NOT NULL,
  `sub_order` int(11) unsigned NOT NULL,
  `sub_perm` varchar(20) NOT NULL,
  PRIMARY KEY (`id_sub`),
  KEY `fk_section` (`fk_section`),
  CONSTRAINT `fk_section` FOREIGN KEY (`fk_section`) REFERENCES `sections` (`id_section`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela next3.sections_sub: ~7 rows (aproximadamente)
DELETE FROM `sections_sub`;
/*!40000 ALTER TABLE `sections_sub` DISABLE KEYS */;
INSERT INTO `sections_sub` (`id_sub`, `fk_section`, `sub_title`, `sub_slug`, `sub_icon`, `sub_order`, `sub_perm`) VALUES
	(1, 3, 'Nova publicação', 'post&action=new', 'fa-plus', 1, 'post_edit'),
	(2, 3, 'Gerenciar', 'post&section=manage', 'fa-copy', 2, 'post_view'),
	(3, 3, 'Categorias', 'category', 'fa-tags', 3, 'post_view'),
	(4, 5, 'Configurações Básicas', 'settings&section=general', 'fa-cog', 1, 'root'),
	(5, 5, 'Configurações de E-mail', 'settings&section=mail', 'fa-envelope', 2, 'root'),
	(6, 5, 'Redes Sociais', 'settings&section=social', 'fa-share-alt', 4, 'settings_view'),
	(7, 5, 'Configurações de Local', 'settings&section=local', 'fa-map-marker', 3, 'settings_view');
/*!40000 ALTER TABLE `sections_sub` ENABLE KEYS */;

-- Copiando estrutura para tabela next3.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `settings_label` varchar(255) COLLATE utf8_bin NOT NULL,
  `settings_value` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `settings_key` varchar(255) COLLATE utf8_bin NOT NULL,
  `settings_field` varchar(15) COLLATE utf8_bin NOT NULL DEFAULT 'text',
  `settings_category` int(11) NOT NULL,
  PRIMARY KEY (`settings_id`),
  KEY `FK_config_config_cat` (`settings_category`),
  CONSTRAINT `FK_config_config_cat` FOREIGN KEY (`settings_category`) REFERENCES `settings_cat` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela next3.settings: ~21 rows (aproximadamente)
DELETE FROM `settings`;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`settings_id`, `settings_label`, `settings_value`, `settings_key`, `settings_field`, `settings_category`) VALUES
	(1, 'Nome do site', 'Next Framework 3', 'site_name', 'text', 1),
	(2, 'Description', 'Framework MVC e CMS em PHP para gerenciamento de websites', 'description', 'text', 1),
	(3, 'Keywords', 'next, framework, mvc, cms, admin, php7', 'keywords', 'text', 1),
	(4, 'Cor Principal do site', '#db4343', 'theme_bar_color', 'text', 1),
	(5, 'Servidor SMTP', 'rbr31.dizinc.com', 'server_smtp', 'text', 2),
	(6, 'Porta SMTP', '465', 'port_smtp', 'text', 2),
	(7, 'E-mail para disparo', 'temporario@kombidesign.com.br', 'user_smtp', 'text', 2),
	(8, 'Facebook', NULL, 'social_fb', 'text', 3),
	(9, 'YouTube', NULL, 'social_yt', 'text', 3),
	(10, 'Telefone', NULL, 'telefone', 'text', 4),
	(11, 'ID Google Analytics', NULL, 'g_analytics', 'text', 1),
	(13, 'Key do Google Maps', NULL, 'g_maps_key', 'text', 1),
	(14, 'Senha para disparo', '18kombidesign18', 'pswd_smtp', 'text', 2),
	(15, 'Instagram', NULL, 'social_it', 'text', 3),
	(16, 'Twitter', NULL, 'social_tw', 'text', 3),
	(17, 'Linkedin', NULL, 'social_lk', 'text', 3),
	(18, 'Endereço', NULL, 'endereco', 'text', 4),
	(19, 'Bairro', NULL, 'neighbor', 'text', 4),
	(20, 'Cidade', NULL, 'city', 'text', 4),
	(21, 'CEP', NULL, 'cep', 'text', 4),
	(22, 'Thumbnail do Facebook', 'facebook-thumb.png', 'fb_thumb', 'text', 1);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- Copiando estrutura para tabela next3.settings_cat
CREATE TABLE IF NOT EXISTS `settings_cat` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(80) NOT NULL,
  `cat_slug` varchar(30) NOT NULL,
  `cat_icon` varchar(80) NOT NULL DEFAULT ' fa-gear',
  `cat_order` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela next3.settings_cat: ~4 rows (aproximadamente)
DELETE FROM `settings_cat`;
/*!40000 ALTER TABLE `settings_cat` DISABLE KEYS */;
INSERT INTO `settings_cat` (`cat_id`, `cat_title`, `cat_slug`, `cat_icon`, `cat_order`) VALUES
	(1, 'Configurações Básicas', 'general', 'fa-wrench', 1),
	(2, 'Configurações de E-mails', 'mail', 'fa-envelope', 3),
	(3, 'Redes Sociais', 'social', 'fa-share-alt', 4),
	(4, 'Configurações de Localização', 'local', 'fa-map-marker', 2);
/*!40000 ALTER TABLE `settings_cat` ENABLE KEYS */;

-- Copiando estrutura para tabela next3.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_login` varchar(60) NOT NULL,
  `user_email` varchar(84) NOT NULL,
  `user_password` varchar(84) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela next3.users: ~4 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`, `user_name`, `user_login`, `user_email`, `user_password`) VALUES
	(1, 'Usuário Root', 'root', 'root@email.com.br', '$2y$10$9zZ8QNAVrxeuf6A8qEgsQu3OQ7sta6htv1jJXYogYN2E7UHMyUQRW'),
	(2, 'Usuário Administrador', 'admin', 'admin@email.com.br', '$2y$10$6H1F33wo9hc8Mku0G6rtRuCmszhxjM47TsUNIJEHFcSxran6x4ziy'),
	(3, 'Usuário Editor', 'editor', 'editor@email.com.br', '$2y$10$Rjr20R0oNALI3cFnmEREfOpx62p3QihWqaEhejMJvSwFpbGSmSERW'),
	(4, 'Usuário Colaborador', 'colaborador', 'colab@email.com.br', '$2y$10$l/MLqIyNm2/zlZENm0BtZ.4jt15hdTx8WgFDt52dgVUwqU0sb.LRu');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
