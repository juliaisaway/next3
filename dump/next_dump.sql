-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.28-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para kdcms_new
CREATE DATABASE IF NOT EXISTS `kdcms_new` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `kdcms_new`;

-- Copiando estrutura para tabela kdcms_new.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_title` varchar(255) DEFAULT NULL,
  `category_slug` varchar(255) DEFAULT NULL,
  `category_color` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela kdcms_new.categories: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT IGNORE INTO `categories` (`category_id`, `category_title`, `category_slug`, `category_color`) VALUES
	(4, 'Categoria 01', 'categoria-01', '#f2ff00'),
	(5, 'Categoria 02', 'cat-02', '#ffc600'),
	(6, 'Categoria 03', 'cat-03', '#00a651'),
	(7, 'Categoria 04', 'cat-04', '#448ccb');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Copiando estrutura para tabela kdcms_new.emails
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela kdcms_new.emails: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
INSERT IGNORE INTO `emails` (`email_id`, `email_date`, `email_name`, `email_email`, `email_phone`, `email_subject`, `email_message`, `email_category`) VALUES
	(1, '2018-01-12 16:53:15', 'Teste de contato', 'teste@teste.com.br', '15 99999.9999', 'Lorem Ipsum', 'Blandit quam a porttitor condimentum sed adipiscing habitant a vestibulum egestas a sociis in adipiscing adipiscing vestibulum nunc. Elementum inceptos tempor malesuada enim fames tempor aliquet vestibulum lorem vestibulum vestibulum quis hac a aliquet diam. Neque arcu vestibulum vestibulum cursus dapibus malesuada commodo adipiscing consectetur ornare dictum sit potenti integer mus nunc est ad aenean a augue nostra aptent a.\r\n\r\nBlandit quam a porttitor condimentum sed adipiscing habitant a vestibulum egestas a sociis in adipiscing adipiscing vestibulum nunc. Elementum inceptos tempor malesuada enim fames tempor aliquet vestibulum lorem vestibulum vestibulum quis hac a aliquet diam. Neque arcu vestibulum vestibulum cursus dapibus malesuada commodo adipiscing consectetur ornare dictum sit potenti integer mus nunc est ad aenean a augue nostra aptent a.', 'Contato');
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;

-- Copiando estrutura para tabela kdcms_new.galleries
CREATE TABLE IF NOT EXISTS `galleries` (
  `gallery_id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_title` varchar(80) NOT NULL,
  `gallery_slug` varchar(80) NOT NULL,
  PRIMARY KEY (`gallery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela kdcms_new.galleries: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
INSERT IGNORE INTO `galleries` (`gallery_id`, `gallery_title`, `gallery_slug`) VALUES
	(3, 'Olha o novo carousel ai rapaziada 2', 'olha-o-novo-carousel-ai-rapaziada-2');
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;

-- Copiando estrutura para tabela kdcms_new.galleries_img
CREATE TABLE IF NOT EXISTS `galleries_img` (
  `galleryimg_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_gallery` int(11) NOT NULL,
  `galleryimg_title` varchar(80) NOT NULL,
  `galleryimg_file` varchar(255) NOT NULL,
  `galleryimg_order` int(11) NOT NULL,
  PRIMARY KEY (`galleryimg_id`),
  KEY `fk_gallery` (`fk_gallery`),
  CONSTRAINT `fk_gallery` FOREIGN KEY (`fk_gallery`) REFERENCES `galleries` (`gallery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela kdcms_new.galleries_img: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `galleries_img` DISABLE KEYS */;
INSERT IGNORE INTO `galleries_img` (`galleryimg_id`, `fk_gallery`, `galleryimg_title`, `galleryimg_file`, `galleryimg_order`) VALUES
	(13, 3, 'Teste 02', 'image-02.jpg', 0),
	(23, 3, 'SSSS', '007.jpg', 2),
	(26, 3, '001', '001.jpg', 1),
	(27, 3, 'Vamos ver', '003.jpg', 3);
/*!40000 ALTER TABLE `galleries_img` ENABLE KEYS */;

-- Copiando estrutura para tabela kdcms_new.log
CREATE TABLE IF NOT EXISTS `log` (
  `log_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `log_date` datetime NOT NULL,
  `log_ip` varchar(60) NOT NULL,
  `log_name` varchar(255) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela kdcms_new.log: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;

-- Copiando estrutura para tabela kdcms_new.media
CREATE TABLE IF NOT EXISTS `media` (
  `media_id` int(11) NOT NULL AUTO_INCREMENT,
  `media_title` varchar(80) NOT NULL,
  `media_file` varchar(255) NOT NULL,
  PRIMARY KEY (`media_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela kdcms_new.media: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT IGNORE INTO `media` (`media_id`, `media_title`, `media_file`) VALUES
	(7, 'Primeiro teste', 'download.jpg'),
	(8, 'Segundo teste', 'media-01.jpg'),
	(10, 'Facebook Thumbnail', 'facebook-thumb.png');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;

-- Copiando estrutura para tabela kdcms_new.posts
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela kdcms_new.posts: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT IGNORE INTO `posts` (`post_id`, `fk_category`, `post_active`, `post_title`, `post_slug`, `post_desc`, `post_content`, `post_file`, `post_date`) VALUES
	(9, 6, 'n', 'Primeira publicação', 'primeira-publicacao', 'Lorem ipsum dolor sit amet', '<p>Potenti scelerisque scelerisque praesent cum sed venenatis vestibulum adipiscing a sapien velit tincidunt tristique nec a. Commodo accumsan a vestibulum curabitur condimentum in parturient vel malesuada velit vestibulum ligula ac penatibus consectetur est per ullamcorper mollis vestibulum leo vehicula. Blandit volutpat gravida vestibulum a parturient suspendisse facilisis suspendisse mollis parturient dis euismod a luctus sem odio sagittis.</p>\r\n<p>Morbi cursus vestibulum sociis vel malesuada blandit orci vestibulum rutrum tellus ut sapien et volutpat ac. Senectus a morbi urna id a eu arcu inceptos hendrerit donec vivamus mi in habitasse commodo nam a. Egestas sodales per parturient vestibulum a penatibus parturient a egestas adipiscing a est risus euismod dui ad non fringilla mus a a cum ut a lorem a.</p>', 'download.jpg', '2018-01-09 11:06:36'),
	(17, 4, 'y', 'Segunda publicação', 'segunda-publicacao', 'Lorem ipsum dolor sit amet consectetur', '<p>Cum turpis a hendrerit maecenas dui vivamus nisl ac justo parturient hendrerit in parturient ac at id a at. Sociis ut nec a faucibus gravida est vestibulum sociosqu praesent mus vel id neque vestibulum leo erat. Natoque vivamus risus duis vel donec curae augue dictumst vestibulum nulla a ut facilisi et condimentum magnis placerat mi ad dui. Pharetra semper cubilia torquent lacinia id adipiscing a curae eleifend malesuada himenaeos scelerisque taciti a. Mas agora foi, n&eacute;? Por favor...</p>\r\n<p><img style="display: block; margin-left: auto; margin-right: auto;" src="http://lorempixel.com/400/400/" alt="" width="400" height="400" /></p>\r\n<p>Maecenas ac lectus eu aptent lacus a platea dapibus commodo parturient ornare diam mollis eros a lacinia quisque per placerat placerat at. Magna a metus hendrerit ac pharetra sit dignissim amet ridiculus velit est ullamcorper massa adipiscing cubilia scelerisque eleifend a pulvinar et condimentum cum dictumst malesuada vestibulum ultricies. Scelerisque a neque est accumsan vivamus interdum ut at rutrum morbi interdum quis maecenas leo a inceptos ultrices tristique at aliquet vitae dolor a adipiscing dui vestibulum.</p>\r\n<p>Scelerisque maecenas litora dapibus bibendum felis bibendum vestibulum mattis parturient fames parturient per sit non egestas faucibus. Consectetur a magna a nec sed eros a et parturient massa amet cum vel morbi scelerisque. Venenatis ullamcorper vestibulum parturient elit habitasse lacinia quam ultrices eget morbi mi a eu at et massa tincidunt a ultrices aenean fames eleifend blandit. Ullamcorper tempor a ut nisi bibendum placerat congue et id curae parturient nunc condimentum vestibulum lacus sociis ut tincidunt elementum condimentum sociis eget. Leo litora amet orci elit ac urna a etiam conubia aliquet quis penatibus mi parturient facilisi suscipit litora hendrerit habitasse pulvinar a vestibulum at condimentum etiam vestibulum vivamus magna.</p>', 'teste.jpg', '2018-01-19 14:30:41'),
	(19, 7, 'y', 'Terceira publicação', 'terceira-publicacao', 'Lorem ipsum dolor sit amet', '<p>At maecenas eget tortor lacinia at ridiculus neque mi scelerisque facilisi morbi sed natoque euismod eu scelerisque velit inceptos a parturient class parturient at quam phasellus. A eleifend nec in sagittis curae at in rutrum nisi id scelerisque ac a lorem suspendisse a nam vestibulum vestibulum. Himenaeos sociosqu a pharetra venenatis accumsan a elementum odio a metus quisque augue elit tellus laoreet sem ultricies. Amet arcu pretium lacinia condimentum ultrices elit nascetur lobortis a massa lobortis ac vitae convallis parturient imperdiet suspendisse suspendisse tincidunt magnis. Erat a enim nisl per inceptos viverra vestibulum scelerisque eros suscipit nisi sit posuere ultricies mus aliquet et iaculis adipiscing suspendisse volutpat a ante per.</p>', 'download_04.jpg', '2018-01-30 14:50:07');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- Copiando estrutura para tabela kdcms_new.role_permissions
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

-- Copiando dados para a tabela kdcms_new.role_permissions: ~18 rows (aproximadamente)
/*!40000 ALTER TABLE `role_permissions` DISABLE KEYS */;
INSERT IGNORE INTO `role_permissions` (`ID`, `Lft`, `Rght`, `Title`, `Description`) VALUES
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

-- Copiando estrutura para tabela kdcms_new.role_rolepermissions
CREATE TABLE IF NOT EXISTS `role_rolepermissions` (
  `RoleID` int(11) NOT NULL,
  `PermissionID` int(11) NOT NULL,
  `AssignmentDate` int(11) NOT NULL,
  PRIMARY KEY (`RoleID`,`PermissionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela kdcms_new.role_rolepermissions: ~17 rows (aproximadamente)
/*!40000 ALTER TABLE `role_rolepermissions` DISABLE KEYS */;
INSERT IGNORE INTO `role_rolepermissions` (`RoleID`, `PermissionID`, `AssignmentDate`) VALUES
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
	(3, 7, 1517226902),
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

-- Copiando estrutura para tabela kdcms_new.role_roles
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

-- Copiando dados para a tabela kdcms_new.role_roles: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `role_roles` DISABLE KEYS */;
INSERT IGNORE INTO `role_roles` (`ID`, `Lft`, `Rght`, `Title`, `Description`) VALUES
	(1, 0, 7, 'root', 'root'),
	(2, 1, 6, 'administrador', 'Administrador do site'),
	(3, 2, 5, 'editor', 'Editor do site'),
	(4, 3, 4, 'colaborador', 'Colaborador do site');
/*!40000 ALTER TABLE `role_roles` ENABLE KEYS */;

-- Copiando estrutura para tabela kdcms_new.role_userroles
CREATE TABLE IF NOT EXISTS `role_userroles` (
  `UserID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL,
  `AssignmentDate` int(11) NOT NULL,
  PRIMARY KEY (`UserID`,`RoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela kdcms_new.role_userroles: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `role_userroles` DISABLE KEYS */;
INSERT IGNORE INTO `role_userroles` (`UserID`, `RoleID`, `AssignmentDate`) VALUES
	(1, 1, 1517227016),
	(2, 2, 1517227016),
	(3, 3, 1517227016),
	(4, 4, 1517227016);
/*!40000 ALTER TABLE `role_userroles` ENABLE KEYS */;

-- Copiando estrutura para tabela kdcms_new.sections
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

-- Copiando dados para a tabela kdcms_new.sections: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT IGNORE INTO `sections` (`id_section`, `section_title`, `section_slug`, `section_icon`, `section_order`, `section_sub`, `section_menu`, `section_perm`) VALUES
	(1, 'Página Inicial', 'home', 'fa-home', 1, 'n', 'y', 'user_view'),
	(2, 'Galeria de Banners', 'gallery', 'fa-tv', 2, 'n', 'y', 'gallery_view'),
	(3, 'Publicações', 'post', 'fa-pencil-square-o', 4, 'y', 'y', 'post_view'),
	(4, 'E-mails', 'emails', 'fa-envelope-o', 6, 'n', 'y', 'mail_view'),
	(5, 'Configurações', 'settings', 'fa-gears', 8, 'y', 'y', 'settings_edit'),
	(6, 'Biblioteca de mídia', 'media', 'fa-image', 3, 'n', 'y', 'media_view'),
	(7, 'Categorias', 'category', 'fa-tags', 5, 'n', 'n', 'post_view'),
	(8, 'Usuários', 'user', 'fa-users', 7, 'n', 'y', 'user_view');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;

-- Copiando estrutura para tabela kdcms_new.sections_sub
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

-- Copiando dados para a tabela kdcms_new.sections_sub: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `sections_sub` DISABLE KEYS */;
INSERT IGNORE INTO `sections_sub` (`id_sub`, `fk_section`, `sub_title`, `sub_slug`, `sub_icon`, `sub_order`, `sub_perm`) VALUES
	(1, 3, 'Nova publicação', 'post&action=new', 'fa-plus', 1, 'post_edit'),
	(2, 3, 'Gerenciar', 'post&section=manage', 'fa-files-o', 2, 'post_view'),
	(3, 3, 'Categorias', 'category', 'fa-tags', 3, 'post_view'),
	(4, 5, 'Configurações Básicas', 'settings&section=general', 'fa-gear', 1, 'root'),
	(5, 5, 'Configurações de E-mail', 'settings&section=mail', 'fa-envelope', 2, 'root'),
	(6, 5, 'Redes Sociais', 'settings&section=social', 'fa-share-alt', 4, 'settings_view'),
	(7, 5, 'Configurações de Local', 'settings&section=local', 'fa-map-marker', 3, 'settings_view');
/*!40000 ALTER TABLE `sections_sub` ENABLE KEYS */;

-- Copiando estrutura para tabela kdcms_new.settings
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela kdcms_new.settings: ~20 rows (aproximadamente)
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT IGNORE INTO `settings` (`settings_id`, `settings_label`, `settings_value`, `settings_key`, `settings_field`, `settings_category`) VALUES
	(1, 'Nome do site', 'Kombi Design CMS', 'site_name', 'text', 1),
	(2, 'Description', 'Framework MVC e CMS em PHP para gerenciamento de websites', 'description', 'text', 1),
	(3, 'Keywords', 'next, framework, mvc, cms, admin, php7', 'keywords', 'text', 1),
	(4, 'Cor Principal do site', '#db4343', 'theme_bar_color', 'text', 1),
	(5, 'Servidor SMTP', 'mail.kombidesign.com.br', 'server_smtp', 'text', 2),
	(6, 'Porta SMTP', '587', 'port_smtp', 'text', 2),
	(7, 'E-mail para disparo', 'temporario@kombidesign.com.br', 'user_smtp', 'text', 2),
	(8, 'Facebook', NULL, 'social_fb', 'text', 3),
	(9, 'YouTube', NULL, 'social_yt', 'text', 3),
	(10, 'Telefone', '(15) 9999.9999', 'telefone', 'text', 4),
	(11, 'ID Google Analytics', 'UA-XXXXX-Y', 'g_analytics', 'text', 1),
	(13, 'Thumbnail do Facebook', 'facebook-thumb.png', 'fb_thumb', 'text', 1),
	(14, 'Senha para disparo', '18kombidesign18', 'pswd_smtp', 'text', 2),
	(15, 'Instagram', NULL, 'social_it', 'text', 3),
	(16, 'Twitter', NULL, 'social_tw', 'text', 3),
	(17, 'Linked In', NULL, 'social_lk', 'text', 3),
	(18, 'Endereço', 'Rua do Teste, 255', 'endereco', 'text', 4),
	(19, 'Bairro', 'Vila do Lorem', 'neighbor', 'text', 4),
	(20, 'Cidade', 'Sorocaba', 'city', 'text', 4),
	(21, 'CEP', '18000-000', 'cep', 'text', 4);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- Copiando estrutura para tabela kdcms_new.settings_cat
CREATE TABLE IF NOT EXISTS `settings_cat` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(80) NOT NULL,
  `cat_slug` varchar(30) NOT NULL,
  `cat_icon` varchar(80) NOT NULL DEFAULT ' fa-gear',
  `cat_order` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela kdcms_new.settings_cat: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `settings_cat` DISABLE KEYS */;
INSERT IGNORE INTO `settings_cat` (`cat_id`, `cat_title`, `cat_slug`, `cat_icon`, `cat_order`) VALUES
	(1, 'Configurações Básicas', 'general', 'fa-wrench', 1),
	(2, 'Configurações de E-mails', 'mail', 'fa-envelope', 3),
	(3, 'Redes Sociais', 'social', 'fa-share-alt', 4),
	(4, 'Configurações de Localização', 'local', 'fa-map-marker', 2);
/*!40000 ALTER TABLE `settings_cat` ENABLE KEYS */;

-- Copiando estrutura para tabela kdcms_new.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_login` varchar(60) NOT NULL,
  `user_email` varchar(84) NOT NULL,
  `user_password` varchar(84) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela kdcms_new.users: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`user_id`, `user_name`, `user_login`, `user_email`, `user_password`) VALUES
	(1, 'Usuário Root', 'root', 'iltonalberto@gmail.com', '$2y$10$9zZ8QNAVrxeuf6A8qEgsQu3OQ7sta6htv1jJXYogYN2E7UHMyUQRW'),
	(2, 'Usuário Administrador', 'admin', 'desenvolvimento2@kombidesign.com.br', '$2y$10$6H1F33wo9hc8Mku0G6rtRuCmszhxjM47TsUNIJEHFcSxran6x4ziy'),
	(3, 'Usuário Editor', 'editor', 'admin@kombidesign.com.br', '$2y$10$Rjr20R0oNALI3cFnmEREfOpx62p3QihWqaEhejMJvSwFpbGSmSERW'),
	(4, 'Usuário Colaborador', 'colaborador', 'colab@kombidesign.com.br', '$2y$10$l/MLqIyNm2/zlZENm0BtZ.4jt15hdTx8WgFDt52dgVUwqU0sb.LRu');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
