# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.42)
# Database: admin
# Generation Time: 2017-07-15 01:44:42 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table books_contactos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `books_contactos`;

CREATE TABLE `books_contactos` (
  `id_contacto` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `fecha_alta` date NOT NULL,
  `empresa` varchar(64) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `telefono` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` tinyint(1) NOT NULL COMMENT '1:Cliente 2:proveedor',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_contacto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

LOCK TABLES `books_contactos` WRITE;
/*!40000 ALTER TABLE `books_contactos` DISABLE KEYS */;

INSERT INTO `books_contactos` (`id_contacto`, `id_empresa`, `fecha_alta`, `empresa`, `telefono`, `tipo`, `activo`)
VALUES
	(1,3,'2017-02-16','EPICMEDIA','9831435202',1,1),
	(2,0,'2017-02-16','SECRETARIA DE SALUD','9834748967',1,1),
	(3,0,'2017-07-03','COCA COLA','',1,1),
	(4,2,'2017-07-05','GOBIERNO DEL ESTADO LIBRE Y SOBERANO DE QUINTANA ROO','9834759842',1,1),
	(5,0,'2017-07-05','MULTIMEDIOS','9283648723',1,1),
	(6,0,'2017-07-06','','2342432334',1,1),
	(7,0,'2017-07-06','','2342432334',1,1),
	(8,0,'2017-07-06','','2342432334',1,1),
	(9,0,'2017-07-06','','2342432334',1,1),
	(10,0,'2017-07-06','','2342432334',1,1),
	(11,0,'2017-07-06','EERG','3454353453',1,1),
	(12,0,'2017-07-06','ERGERGERG','43534534',1,1),
	(13,0,'2017-07-06','ERGERGERG','43534534',1,1),
	(14,0,'2017-07-06','WEFWF','5345345345',1,1),
	(15,2,'2017-07-06','PIXEL COMUNICACIONES','7846583746',1,1),
	(16,0,'2017-07-06','CEMENTOS DE MÃ‰XICO S.A DE CV','2342432334',1,1),
	(17,0,'2017-07-06','CEMENTOS DE MÃ‰XICO S.A DE CV','2342432334',1,1),
	(18,0,'2017-07-06','WDWEFWF','2342432334',1,1),
	(19,0,'2017-07-06','SECRETARIA DE SALUD','9834748967',1,1),
	(20,0,'2017-07-06','TACO LOCO','9831055521',1,1),
	(21,0,'2017-07-06','UNIVERSAL ESTUDIOS','2342432334',1,1),
	(22,2,'2017-07-06','el cochiloco','9831435202',1,1),
	(23,2,'2017-07-06','el cochiloco','9831435202',1,1),
	(24,2,'2017-07-06','unicarl rogers','3453453453',1,1),
	(25,2,'2017-07-06','unicarl rogers','3453453453',1,1),
	(26,2,'2017-07-06','unicarl rogers','3453453453',2,1),
	(27,2,'2017-07-06','chetumenu','3487568374',1,1),
	(28,2,'2017-07-06','chetumenu','3487568374',1,1),
	(29,2,'2017-07-06','CHETUMENU','3487568374',1,1),
	(30,2,'2017-07-06','CHETUMENU','3487568374',1,1),
	(31,2,'2017-07-06','CHETUMENU','3487568374',1,1),
	(32,2,'2017-07-06','CHETUMENU','3487568374',1,1),
	(33,2,'2017-07-06','GOBIERNO DEL ESTADO LIBRE Y SOBERANO DE QUINTANA ROO2','9834759842',2,1),
	(34,1,'2017-07-06','EPICMEDIA','9831621220',2,1);

/*!40000 ALTER TABLE `books_contactos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table books_contactos_personas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `books_contactos_personas`;

CREATE TABLE `books_contactos_personas` (
  `id_contacto_persona` int(11) NOT NULL AUTO_INCREMENT,
  `id_contacto` int(11) NOT NULL,
  `nombre` varchar(96) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `principal` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_contacto_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

LOCK TABLES `books_contactos_personas` WRITE;
/*!40000 ALTER TABLE `books_contactos_personas` DISABLE KEYS */;

INSERT INTO `books_contactos_personas` (`id_contacto_persona`, `id_contacto`, `nombre`, `email`, `principal`)
VALUES
	(1,14,'qdwqdw','qd@ewf.com',0),
	(2,15,'josuÃ© gonzÃ¡lez','josue@pixel.com',0),
	(3,16,'juan perez','jperez@me.com',0),
	(4,17,'juan perez','jperez@me.com',0),
	(5,18,'wef','wef@wedf.com',0),
	(6,19,'Adolfo','adolfo@epicmedia.pro',0),
	(7,20,'ADOLFO','adolfoflores@me.com',0),
	(8,20,'Diego','diegoflores@me.com',0),
	(9,21,'dger','dssd@ewf.com',0),
	(10,4,'Jose Lopez','jose@qroo.com',0),
	(11,4,'DAMRIS MARTINEZ','damaris@qroo.com',1),
	(15,22,'','',0),
	(16,24,'Juan lopez','juan@me.com',0),
	(17,25,'Juan lopez','juan@me.com',1),
	(18,26,'Juan lopez','juan@me.com',1),
	(19,27,'jose perez','jose@me.com',1),
	(20,27,'juan perez','juan@me.com',0),
	(21,28,'jose perez','jose@me.com',1),
	(22,28,'juan perez','juan@me.com',0),
	(23,29,'JOSE PEREZ','JOSE@ME.COM',1),
	(24,29,'JUAN PEREZ','JUAN@ME.COM',0),
	(25,30,'JOSE PEREZ','JOSE@ME.COM',1),
	(26,30,'JUAN PEREZ','Juan@me.com',0),
	(27,31,'JOSE PEREZ','JOSE@ME.COM',1),
	(28,31,'JUAN PEREZ','juan@me.com',0),
	(29,32,'JOSE PEREZ','jose@me.com',1),
	(30,32,'JUAN PEREZ','juan@me.com',0),
	(31,33,'DAMRIS MARTINEZ2','damaris@qroo.com2',1),
	(32,4,'DIEGO','diego@lol.com',0),
	(33,34,'ADOLFO ALBERTO FLORES AREVALO','adolfo@epicmedia.pro',0),
	(34,34,'1','1',0),
	(35,34,'ADA','asfafasfasf',1),
	(36,34,'1','1',0),
	(37,34,'1','1',0);

/*!40000 ALTER TABLE `books_contactos_personas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table books_cuentas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `books_cuentas`;

CREATE TABLE `books_cuentas` (
  `id_cuenta` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `alias` varchar(64) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_cuenta` tinyint(1) NOT NULL COMMENT '1=caja chica - 2=Efectivo - 3=banco',
  `fecha_creacion` date NOT NULL,
  `eliminable` tinyint(1) DEFAULT '1',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_cuenta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

LOCK TABLES `books_cuentas` WRITE;
/*!40000 ALTER TABLE `books_cuentas` DISABLE KEYS */;

INSERT INTO `books_cuentas` (`id_cuenta`, `id_empresa`, `alias`, `tipo_cuenta`, `fecha_creacion`, `eliminable`, `activo`)
VALUES
	(1,1,'EFECTIVO',2,'0000-00-00',0,1),
	(2,1,'BANCO',3,'0000-00-00',0,1),
	(3,1,'SANTANDER',3,'0000-00-00',1,1),
	(4,1,'EFECTIVO',2,'0000-00-00',0,1),
	(5,1,'BANCO',3,'0000-00-00',0,1),
	(6,2,'EFECTIVO',2,'2017-02-24',0,1),
	(7,2,'BANCO',3,'2017-02-24',0,1),
	(8,2,'EFECTIVO',2,'0000-00-00',0,1),
	(9,2,'BANCO',3,'0000-00-00',0,1),
	(10,3,'EFECTIVO',2,'0000-00-00',0,1),
	(11,3,'BANCO',3,'0000-00-00',0,1),
	(12,4,'EFECTIVO',2,'0000-00-00',0,1),
	(13,4,'BANCO',3,'0000-00-00',0,1),
	(14,5,'EFECTIVO',2,'0000-00-00',0,1),
	(15,5,'BANCO',3,'0000-00-00',0,1);

/*!40000 ALTER TABLE `books_cuentas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table books_empresas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `books_empresas`;

CREATE TABLE `books_empresas` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `colonia` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ciudad` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `codigo_postal` varchar(5) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono_1` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono_2` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `web` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `logo` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `color` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_creacion` date NOT NULL,
  `mensaje_presupuesto` text COLLATE utf8_spanish_ci,
  `mensaje_remision` text COLLATE utf8_spanish_ci,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

LOCK TABLES `books_empresas` WRITE;
/*!40000 ALTER TABLE `books_empresas` DISABLE KEYS */;

INSERT INTO `books_empresas` (`id_empresa`, `empresa`, `direccion`, `colonia`, `ciudad`, `estado`, `codigo_postal`, `telefono_1`, `telefono_2`, `web`, `logo`, `color`, `fecha_creacion`, `mensaje_presupuesto`, `mensaje_remision`, `activo`)
VALUES
	(1,'COMPU PLAZA','Torcasa #108 Entre Chunya Y Tela','Col. Emancipacion','Chetumal','Quintana Roo','77000','9831454934','9837331035','http://compuplaza.mx','42433.png','#CC0033','2017-02-15','<p> Estimado/a NOMBRE_CLIENTE:\n</p><p>\nGracias por ponerse en contacto con nosotros.\n</p><p>\nLe enviamos su NUMERO_FOLIO que amablemente nos ha solicitado en el archivo adjunto.\n</p><p>\n\nEsperamos poder trabajar con usted.\n</p><p>\n\nSaludos cordiales,\n<br>NOMBRE_USUARIO\n<br><br>EPICMEDIA\n<br>Av. Alvaro Obreg&oacute;n 449-A\n<br>Centro, 77000\nChetumal, Quintana Roo\nM&eacute;xico</p>',NULL,1),
	(2,'EPICMEDIA','Efrain aguilar #384',NULL,'Chetumal','Quintana Roo','77000','9831435202',NULL,'http://epicmedia.pro','42433.png','#000000','2017-04-07',NULL,NULL,1),
	(5,'DIGMASTUDIO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'#000000','2017-06-28',NULL,NULL,1);

/*!40000 ALTER TABLE `books_empresas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table books_gastos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `books_gastos`;

CREATE TABLE `books_gastos` (
  `id_gasto` int(11) NOT NULL AUTO_INCREMENT,
  `id_cuenta` int(11) NOT NULL,
  `id_cuenta_receptora` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_metodo_pago` int(11) NOT NULL,
  `id_tipo_gasto` int(11) NOT NULL,
  `fecha_hora_captura` datetime NOT NULL,
  `fecha_gasto` date NOT NULL,
  `monto` decimal(12,2) NOT NULL,
  `referencia` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `notas` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_gasto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



# Dump of table books_ingresos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `books_ingresos`;

CREATE TABLE `books_ingresos` (
  `id_ingreso` int(11) NOT NULL AUTO_INCREMENT,
  `id_cuenta` int(11) NOT NULL,
  `id_cuenta_emisora` int(11) DEFAULT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_corte` int(11) NOT NULL,
  `id_metodo_pago` int(11) NOT NULL,
  `id_tipo_ingreso` int(11) NOT NULL,
  `fecha_hora_captura` datetime NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `monto` decimal(12,2) NOT NULL,
  `referencia` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `notas` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_ingreso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



# Dump of table books_logs_ventas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `books_logs_ventas`;

CREATE TABLE `books_logs_ventas` (
  `id_log_presupuesto` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_venta` int(11) DEFAULT NULL,
  `log` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `tipo` tinyint(1) DEFAULT NULL COMMENT '1: creación - 2: edición - 3:eliminación - 4:convertido en factura - 5:comentario',
  PRIMARY KEY (`id_log_presupuesto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

LOCK TABLES `books_logs_ventas` WRITE;
/*!40000 ALTER TABLE `books_logs_ventas` DISABLE KEYS */;

INSERT INTO `books_logs_ventas` (`id_log_presupuesto`, `id_venta`, `log`, `fecha_hora`, `tipo`)
VALUES
	(1,12,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO.','2017-02-24 16:39:38',1),
	(2,13,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO.','2017-02-24 16:39:48',1),
	(3,14,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO.','2017-04-07 14:45:18',1),
	(4,15,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO.','2017-04-07 15:29:19',1),
	(5,16,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO.','2017-04-07 15:34:00',1),
	(6,17,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO.','2017-04-07 15:34:47',1),
	(7,18,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO.','2017-04-11 13:18:59',1),
	(8,1,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO.','2017-04-13 14:48:14',1),
	(10,19,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO.','2017-06-28 15:01:35',1),
	(11,20,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO.','2017-06-28 15:03:45',1),
	(12,21,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO.','2017-06-28 15:15:10',1),
	(13,30,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO.','2017-06-28 16:10:00',1),
	(14,21,'EL USUARIO DIEGO CAMACHO A CANCELADO EL PRESUPUESTO.','2017-06-29 17:11:06',1),
	(15,31,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO.','2017-07-03 14:52:35',1),
	(16,31,'EL USUARIO DIEGO CAMACHO HA EDITADO EL PRESUPUESTO.','2017-07-03 15:49:11',1),
	(17,31,'EL USUARIO DIEGO CAMACHO HA EDITADO EL PRESUPUESTO.','2017-07-03 15:57:18',1),
	(18,31,'EL USUARIO DIEGO CAMACHO HA EDITADO EL PRESUPUESTO.','2017-07-03 15:58:10',1),
	(19,31,'EL USUARIO DIEGO CAMACHO A CANCELADO EL PRESUPUESTO.','2017-07-03 15:58:57',1),
	(20,35,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO. APARTIR DE UNA CLONACIÃ“N','2017-07-03 16:34:42',1),
	(21,36,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO. APARTIR DE UNA CLONACIÃ“N','2017-07-03 16:35:14',1),
	(22,15,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO. APARTIR DE UNA CLONACIÃ“N','2017-07-03 16:42:36',1),
	(23,22,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO. APARTIR DE UNA CLONACIÃ“N','2017-07-03 16:43:18',1),
	(24,29,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO. APARTIR DE UNA CLONACIÃ“N','2017-07-03 16:43:37',1),
	(25,40,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO. APARTIR DE UNA CLONACIÃ“N','2017-07-03 16:44:51',1),
	(26,40,'EL USUARIO DIEGO CAMACHO HA EDITADO EL PRESUPUESTO.','2017-07-03 16:45:59',1),
	(27,1,'x','2017-07-03 17:54:14',1),
	(28,17,'x','2017-07-03 17:55:46',1),
	(29,1,'EL USUARIO DIEGO CAMACHO A CANCELADO EL PRESUPUESTO.','2017-07-03 17:55:51',1),
	(30,1,'x','2017-07-03 17:55:59',1),
	(31,41,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO. APARTIR DE UNA CLONACIÃ“N','2017-07-03 17:56:19',1),
	(32,1,'EL USUARIO DIEGO CAMACHO A CANCELADO EL PRESUPUESTO.','2017-07-03 18:41:11',1),
	(33,42,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO. APARTIR DE UNA CLONACIÃ“N','2017-07-03 19:47:43',1),
	(34,43,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO.','2017-07-03 20:00:06',1),
	(35,45,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO.','2017-07-04 12:00:52',1),
	(46,46,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO.','2017-07-04 13:08:25',1),
	(47,47,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO.','2017-07-04 13:09:01',1),
	(49,47,'EL USUARIO DIEGO CAMACHO HA EDITADO EL PRESUPUESTO.','2017-07-04 13:11:05',1),
	(50,48,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO.','2017-07-04 13:50:12',1),
	(51,1,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO.','2017-07-04 14:01:23',1),
	(52,1,'EL USUARIO DIEGO CAMACHO HA EDITADO EL PRESUPUESTO.','2017-07-05 20:20:01',1),
	(53,1,'EL USUARIO DIEGO CAMACHO A CANCELADO EL PRESUPUESTO.','2017-07-05 20:20:15',1),
	(54,1,'x','2017-07-05 20:20:21',1),
	(55,2,'EL USUARIO DIEGO CAMACHO HA CREADO EL PRESUPUESTO.','2017-07-06 13:59:05',1);

/*!40000 ALTER TABLE `books_logs_ventas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table books_metodo_pago
# ------------------------------------------------------------

DROP TABLE IF EXISTS `books_metodo_pago`;

CREATE TABLE `books_metodo_pago` (
  `id_metodo_pago` int(11) NOT NULL AUTO_INCREMENT,
  `metodo_pago` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_metodo_pago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

LOCK TABLES `books_metodo_pago` WRITE;
/*!40000 ALTER TABLE `books_metodo_pago` DISABLE KEYS */;

INSERT INTO `books_metodo_pago` (`id_metodo_pago`, `metodo_pago`, `activo`)
VALUES
	(1,'EFECTIVO',1),
	(2,'TRANSFERENCIA ELECTR&Oacute;NICA',1),
	(3,'TARJETA DE CR&Eacute;DITO / D&Eacute;BITO',1),
	(4,'CHEQUE',1);

/*!40000 ALTER TABLE `books_metodo_pago` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table books_presupuestos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `books_presupuestos`;

CREATE TABLE `books_presupuestos` (
  `id_presupuesto` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_contacto` int(11) NOT NULL,
  `folio_presupuesto` int(11) NOT NULL DEFAULT '0',
  `fecha_hora_creacion` datetime NOT NULL,
  `fecha` date NOT NULL,
  `fecha_expira` date NOT NULL,
  `notas` varchar(255) NOT NULL DEFAULT '',
  `ajuste_text` varchar(40) NOT NULL DEFAULT '',
  `ajuste_monto` decimal(12,2) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1- Borrador   - Enviado (SI YA EXPIRÓ SE MUESTRA COMO VENCIDO, Si nunca expira siempre queda en ENVIADO) SI SE REMITE PASA A REMITIDO   3- Aceptado (RE-001 muestra remisión)   4- Rechazado',
  `visto` tinyint(1) NOT NULL DEFAULT '0',
  `visto_fecha_hora` datetime DEFAULT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_presupuesto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `books_presupuestos` WRITE;
/*!40000 ALTER TABLE `books_presupuestos` DISABLE KEYS */;

INSERT INTO `books_presupuestos` (`id_presupuesto`, `id_usuario`, `id_empresa`, `id_contacto`, `folio_presupuesto`, `fecha_hora_creacion`, `fecha`, `fecha_expira`, `notas`, `ajuste_text`, `ajuste_monto`, `estado`, `visto`, `visto_fecha_hora`, `activo`)
VALUES
	(1,1,2,1,1,'2017-07-04 14:01:23','2017-07-04','2017-07-23','Notas para el cliente aquÃ­.','Ajuste por que si',500.00,1,0,NULL,1),
	(2,1,2,1,2,'2017-07-06 13:59:05','2017-07-06','2017-07-09','Notas','Ajuste',80.00,1,0,NULL,1);

/*!40000 ALTER TABLE `books_presupuestos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table books_presupuestos_producto
# ------------------------------------------------------------

DROP TABLE IF EXISTS `books_presupuestos_producto`;

CREATE TABLE `books_presupuestos_producto` (
  `id_presupuesto_producto` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_presupuesto` int(11) DEFAULT NULL,
  `producto` text NOT NULL,
  `cantidad` decimal(14,4) unsigned NOT NULL,
  `tarifa` decimal(14,4) DEFAULT NULL,
  `descuento` decimal(7,4) unsigned NOT NULL,
  `impuesto` decimal(7,4) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_presupuesto_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `books_presupuestos_producto` WRITE;
/*!40000 ALTER TABLE `books_presupuestos_producto` DISABLE KEYS */;

INSERT INTO `books_presupuestos_producto` (`id_presupuesto_producto`, `id_presupuesto`, `producto`, `cantidad`, `tarifa`, `descuento`, `impuesto`)
VALUES
	(4,1,'LAPTOP HP MODELO 14914\r\n- MEMORIA RAM 100 GB\r\n- HDD 200 GB\r\n- VENTILADOR 2017\r\n- MOUSE Y RATON INALABRICOS MODELO 184\r\nNUMERO DE SERIE: 129414124129481',1.0000,1500.0000,10.0000,16.0000),
	(5,1,'IPHONE 7 PLUS\r\n- 8 GB DE MEMORIA\r\n- 193 GB DE RAM\r\n- COLOR ROJO MAMADOR\r\n- GARANTIA 10 AÃ‘OS',4.0000,1000.0000,0.0000,16.0000),
	(6,1,'MONITOR HP 70\"\r\n- TAMAÃ‘O GRANDE\r\n- LCD LED\r\n- A 220\r\n- ENVIO GRATIS\r\nSERIE: 149184048104914\r\n\r\n',10.0000,500.0000,0.0000,16.0000),
	(7,2,'DESC 1',1.0000,1000.0000,10.0000,0.0000),
	(8,2,'DESC 2',1.0000,2000.0000,0.0000,16.0000);

/*!40000 ALTER TABLE `books_presupuestos_producto` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table books_proveedores
# ------------------------------------------------------------

DROP TABLE IF EXISTS `books_proveedores`;

CREATE TABLE `books_proveedores` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `fecha_alta` date NOT NULL,
  `proveedor` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `representante` varchar(64) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(10) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `email` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

LOCK TABLES `books_proveedores` WRITE;
/*!40000 ALTER TABLE `books_proveedores` DISABLE KEYS */;

INSERT INTO `books_proveedores` (`id_proveedor`, `id_empresa`, `fecha_alta`, `proveedor`, `representante`, `telefono`, `email`, `activo`)
VALUES
	(1,1,'2017-02-17','EPICMEDIA','DIEGO CAMACHO','9831435202','diego@epicmedia.pro',1),
	(2,0,'2017-02-17','COCA COLA','JORGE PEREZ','9836268766','jperez@cocacoal.com.mx',1);

/*!40000 ALTER TABLE `books_proveedores` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table books_remisiones
# ------------------------------------------------------------

DROP TABLE IF EXISTS `books_remisiones`;

CREATE TABLE `books_remisiones` (
  `id_remision` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_contacto` int(11) NOT NULL,
  `folio_remision` int(11) NOT NULL DEFAULT '0',
  `fecha_hora_creacion` datetime NOT NULL,
  `fecha` date NOT NULL,
  `fecha_expira` date NOT NULL,
  `notas` varchar(255) NOT NULL DEFAULT '',
  `terminos_condiciones` text NOT NULL,
  `ajuste_text` varchar(40) NOT NULL DEFAULT '',
  `ajuste_monto` decimal(12,2) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1- Borrador   2- Enviado (no se muestra enviado, solo se muestra cuando va a vencer o si ya venció)   3- Parcialmente pagado   4- Pagado   5- Anulado',
  `visto` tinyint(1) NOT NULL DEFAULT '0',
  `visto_fecha_hora` datetime DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_remision`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table books_remisiones_producto
# ------------------------------------------------------------

DROP TABLE IF EXISTS `books_remisiones_producto`;

CREATE TABLE `books_remisiones_producto` (
  `id_presupuesto_producto` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_presupuesto` int(11) DEFAULT NULL,
  `producto` text NOT NULL,
  `cantidad` decimal(14,4) unsigned NOT NULL,
  `tarifa` decimal(14,4) DEFAULT NULL,
  `descuento` decimal(7,4) unsigned NOT NULL,
  `impuesto` decimal(7,4) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_presupuesto_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table books_tipos_gasto
# ------------------------------------------------------------

DROP TABLE IF EXISTS `books_tipos_gasto`;

CREATE TABLE `books_tipos_gasto` (
  `id_tipo_gasto` int(11) NOT NULL AUTO_INCREMENT,
  `cuenta_gasto` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `eliminable` tinyint(4) NOT NULL DEFAULT '1',
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_tipo_gasto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

LOCK TABLES `books_tipos_gasto` WRITE;
/*!40000 ALTER TABLE `books_tipos_gasto` DISABLE KEYS */;

INSERT INTO `books_tipos_gasto` (`id_tipo_gasto`, `cuenta_gasto`, `eliminable`, `activo`)
VALUES
	(1,'TRANSFERENCIA DE FONDOS',0,1),
	(2,'CFE',1,1);

/*!40000 ALTER TABLE `books_tipos_gasto` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table books_tipos_ingreso
# ------------------------------------------------------------

DROP TABLE IF EXISTS `books_tipos_ingreso`;

CREATE TABLE `books_tipos_ingreso` (
  `id_tipo_ingreso` int(11) NOT NULL AUTO_INCREMENT,
  `cuenta_ingreso` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `eliminable` tinyint(1) NOT NULL DEFAULT '1',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_tipo_ingreso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

LOCK TABLES `books_tipos_ingreso` WRITE;
/*!40000 ALTER TABLE `books_tipos_ingreso` DISABLE KEYS */;

INSERT INTO `books_tipos_ingreso` (`id_tipo_ingreso`, `cuenta_ingreso`, `eliminable`, `activo`)
VALUES
	(1,'TRANSFERENCIA DE FONDOS',0,1),
	(2,'PUBLICO EN GENERAL',0,1);

/*!40000 ALTER TABLE `books_tipos_ingreso` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table books_usuarios_empresas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `books_usuarios_empresas`;

CREATE TABLE `books_usuarios_empresas` (
  `id_usuario_empresa` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

LOCK TABLES `books_usuarios_empresas` WRITE;
/*!40000 ALTER TABLE `books_usuarios_empresas` DISABLE KEYS */;

INSERT INTO `books_usuarios_empresas` (`id_usuario_empresa`, `id_usuario`, `id_empresa`)
VALUES
	(1,1,1),
	(2,1,2),
	(4,1,5),
	(5,7,1);

/*!40000 ALTER TABLE `books_usuarios_empresas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tipo_usuario
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tipo_usuario`;

CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_usuario` varchar(64) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

LOCK TABLES `tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `tipo_usuario`)
VALUES
	(1,'ADMINISTRADOR'),
	(2,'OPERADOR');

/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table usuarios
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id_usuario` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_tipo_usuario` tinyint(1) DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `pass` varchar(36) CHARACTER SET utf8 DEFAULT NULL,
  `celular` varchar(12) CHARACTER SET utf8 DEFAULT NULL,
  `ultimo_acceso` datetime DEFAULT NULL,
  `foto` varchar(128) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'bot_icon.png',
  `activo` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;

INSERT INTO `usuarios` (`id_usuario`, `id_tipo_usuario`, `nombre`, `email`, `pass`, `celular`, `ultimo_acceso`, `foto`, `activo`)
VALUES
	(1,1,'DIEGO CAMACHO','diego@epicmedia.pro','c4ca4238a0b923820dcc509a6f75849b','9831435202','2017-07-12 18:07:12','436_20170216.png',1),
	(2,1,'ERGERG ERGERG','egrerg@me.com','c81e728d9d4c2f636f067f89cc14862c','3454353453',NULL,'854_20161226.png',1),
	(3,2,'DOCTOR  LOPEZ','doc@me.com','c4ca4238a0b923820dcc509a6f75849b','7534785687','2016-12-26 15:02:04','436_20170216.png',1),
	(4,1,'RENE QUIJANO','rene@me.com','c4ca4238a0b923820dcc509a6f75849b','3724832468',NULL,'690_20170216.png',1),
	(5,2,'MILTON LOPEZ','milton@me.com','c4ca4238a0b923820dcc509a6f75849b','2398746723',NULL,'436_20170216.png',1),
	(6,2,'MILTON LOPEZ JUÃREZ','milton2@me.com','c4ca4238a0b923820dcc509a6f75849b','9384759834',NULL,'436_20170216.png',1),
	(7,1,'ADOLFO FLORES','adolfo','c4ca4238a0b923820dcc509a6f75849b','9831621220','2017-06-27 14:31:39','436_20170216.png',1),
	(8,NULL,NULL,NULL,NULL,NULL,NULL,'bot_icon.png',1);

/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
