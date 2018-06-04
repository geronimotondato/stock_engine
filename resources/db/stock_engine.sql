CREATE DATABASE  IF NOT EXISTS `stock_engine` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `stock_engine`;
-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: stock_engine
-- ------------------------------------------------------
-- Server version	5.6.24

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `almacen`
--

DROP TABLE IF EXISTS `almacen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `almacen` (
  `id_almacen` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_almacen`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`),
  UNIQUE KEY `id_almacen_UNIQUE` (`id_almacen`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `almacen`
--

LOCK TABLES `almacen` WRITE;
/*!40000 ALTER TABLE `almacen` DISABLE KEYS */;
INSERT INTO `almacen` VALUES (1,'almacen1','calle 1 monte grande','4343455');
/*!40000 ALTER TABLE `almacen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`id_categoria`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`),
  UNIQUE KEY `id_categoria_producto_UNIQUE` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (5,'perfume','todo tipo de perfume');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`,`ip_address`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ci_sessions`
--

LOCK TABLES `ci_sessions` WRITE;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` VALUES ('25it3psic1mt15nrfgd27238qi49bvkq','::1',1528145726,'__ci_last_regenerate|i:1528145647;username|s:2:\"yo\";nombre|s:2:\"yo\";apellido|s:2:\"yo\";logged_in|b:1;'),('kmo6eaemjve6jip42bds8php11m3ev8v','::1',1528082785,'__ci_last_regenerate|i:1528082782;username|s:2:\"yo\";nombre|s:2:\"yo\";apellido|s:2:\"yo\";logged_in|b:1;side_bar|s:6:\"ventas\";__ci_vars|a:1:{s:8:\"side_bar\";s:3:\"new\";}');
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `tel_movil` varchar(45) DEFAULT NULL,
  `tel_fijo` varchar(45) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `saldo` float DEFAULT '0',
  `dado_de_baja` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `id_cliente_UNIQUE` (`id_cliente`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`),
  FULLTEXT KEY `busqueda_cliente` (`nombre`,`direccion`,`email`,`tel_movil`,`tel_fijo`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (26,'geronimo','Belgrano 851','1163602918','42902986','geronimo.tondato@gmail.com',0,1),(29,'Geronimo Tondato','Belgrano 851','1163602918','42902986','geronimo.tondato@gmail.com',0,1),(41,'juan','','','','',-60,0),(42,'antonio','','','','',60,0),(43,'juana','','','','',-200,0),(44,'domingo','','','','',0,0),(45,'mesa 1','','','','',0,0),(46,'juana mazza','','','','',0,0);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_item`
--

DROP TABLE IF EXISTS `historial_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historial_item` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `id_venta` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `unidades` int(11) NOT NULL,
  `costo` float NOT NULL,
  `precio_venta` float NOT NULL,
  `cantidad` int(11) NOT NULL,
  `descuento` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_item`),
  KEY `id_venta_idx` (`id_venta`),
  CONSTRAINT `id_venta` FOREIGN KEY (`id_venta`) REFERENCES `historial_venta` (`id_venta`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_item`
--

LOCK TABLES `historial_item` WRITE;
/*!40000 ALTER TABLE `historial_item` DISABLE KEYS */;
INSERT INTO `historial_item` VALUES (16,8,'producto1',1,10,12,10,0),(17,8,'producto2',1,20,24,7,0),(19,9,'producto1',1,10,12,4,0),(20,9,'producto1',1,10,12,6,0),(21,9,'producto3',1,30,36,1,0),(22,10,'producto3',1,30,36,5,0),(23,11,'servicio',1,0,400,9,0),(24,12,'producto1',1,10,12,5,0),(25,12,'servicio',1,0,400,3,0),(27,13,'servicio2',0,0,300,8,0);
/*!40000 ALTER TABLE `historial_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_venta`
--

DROP TABLE IF EXISTS `historial_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historial_venta` (
  `id_venta` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `fecha_alta` datetime NOT NULL,
  `fecha_venta` date NOT NULL,
  PRIMARY KEY (`id_venta`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_venta`
--

LOCK TABLES `historial_venta` WRITE;
/*!40000 ALTER TABLE `historial_venta` DISABLE KEYS */;
INSERT INTO `historial_venta` VALUES (8,41,'2018-06-01 19:11:24','2018-06-02'),(9,45,'2018-06-01 23:34:25','2018-06-02'),(10,41,'2018-06-02 16:39:23','2018-07-01'),(11,42,'2018-06-03 23:14:44','2018-06-04'),(12,41,'2018-06-03 23:19:00','2018-06-04'),(13,45,'2018-06-03 23:30:23','2018-06-04');
/*!40000 ALTER TABLE `historial_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `descuento` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_item`,`id_venta`,`id_producto`),
  KEY `fk_producto_has_venta_producto1_idx` (`id_producto`),
  KEY `fk_item_venta1_idx` (`id_venta`),
  CONSTRAINT `fk_item_id_venta` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_has_venta_producto1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (65,22,3,5,0),(66,22,1,2,0);
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `unidades` int(11) NOT NULL DEFAULT '0',
  `costo` float NOT NULL DEFAULT '0',
  `precio_venta` float NOT NULL DEFAULT '0',
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stock` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `id_almacen` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `id_categoria_idx` (`id_categoria`),
  KEY `id_almacen_idx` (`id_almacen`),
  CONSTRAINT `id_almacen` FOREIGN KEY (`id_almacen`) REFERENCES `almacen` (`id_almacen`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'producto1',1,10,12,'2018-06-01 19:10:58',975,NULL,NULL),(2,'producto2',1,20,24,'2018-06-01 19:10:58',1993,NULL,NULL),(3,'producto3',1,30,36,'2018-06-01 19:10:58',2994,NULL,NULL),(4,'5 minutos',1,0,10,'2018-06-01 23:42:43',1000,NULL,NULL),(5,'1 hora',1,0,120,'2018-06-01 23:46:27',10000,5,NULL),(7,'servicio2',0,0,300,'2018-06-03 23:27:44',NULL,5,NULL);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (5,'yo','yo','yo','$2y$11$rKE3AN1IQWwX/8yfMpoIYO3s5mDgftl73NPr/YFjUJCkWI.fr.Ef6');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta`
--

DROP TABLE IF EXISTS `venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `fecha_alta` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_venta` date NOT NULL,
  PRIMARY KEY (`id_venta`),
  KEY `id_cliente` (`id_cliente`),
  CONSTRAINT `id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta`
--

LOCK TABLES `venta` WRITE;
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
INSERT INTO `venta` VALUES (22,43,'2018-06-04 00:22:58','2018-06-04');
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vista_stock`
--

DROP TABLE IF EXISTS `vista_stock`;
/*!50001 DROP VIEW IF EXISTS `vista_stock`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_stock` AS SELECT 
 1 AS `producto`,
 1 AS `unidades`,
 1 AS `precio_venta`,
 1 AS `comprometidos`,
 1 AS `disponibles`,
 1 AS `stock_total`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'stock_engine'
--

--
-- Dumping routines for database 'stock_engine'
--
/*!50003 DROP PROCEDURE IF EXISTS `finalizar_venta` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `finalizar_venta`(id_venta INT)
BEGIN


START TRANSACTION;

INSERT INTO historial_venta (id_cliente, fecha_venta, fecha_entrega)
SELECT id_cliente, fecha_venta, fecha_entrega
FROM   venta o
WHERE  o.id_venta = id_venta;

SET @last_insert = LAST_INSERT_ID();

INSERT INTO historial_item (id_venta, nombre, unidades, precio_compra, precio_venta, cantidad, descuento)
SELECT @last_insert AS id_venta, p.nombre, p.unidades, p.precio_compra, p.precio_venta, i.cantidad, i.descuento FROM item i JOIN producto p ON i.id_producto = p.id_producto WHERE i.id_venta = id_venta;

UPDATE 	producto dest,
		(SELECT i.id_producto, sum(i.cantidad) AS suma FROM item i WHERE i.id_venta = id_venta GROUP BY i.id_producto) src
       
		SET dest.stock = dest.stock - src.suma
		WHERE dest.id_producto = src.id_producto;

DELETE FROM venta WHERE venta.id_venta = id_venta;
DELETE FROM item WHERE item.id_venta = id_venta;

COMMIT;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `vista_stock`
--

/*!50001 DROP VIEW IF EXISTS `vista_stock`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_stock` AS select `p`.`nombre` AS `producto`,`p`.`unidades` AS `unidades`,`p`.`precio_venta` AS `precio_venta`,coalesce(sum(`i`.`cantidad`),0) AS `comprometidos`,coalesce((`p`.`stock` - coalesce(sum(`i`.`cantidad`),0)),0) AS `disponibles`,`p`.`stock` AS `stock_total` from (`producto` `p` left join `item` `i` on((`p`.`id_producto` = `i`.`id_producto`))) group by `p`.`id_producto` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-04 18:01:00
