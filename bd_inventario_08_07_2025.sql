-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para sys_inventario_transber
CREATE DATABASE IF NOT EXISTS `sys_inventario_transber` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `sys_inventario_transber`;

-- Volcando estructura para tabla sys_inventario_transber.tbl_accesorios
CREATE TABLE IF NOT EXISTS `tbl_accesorios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ns` varchar(255) NOT NULL,
  `id_modelo` int(10) unsigned NOT NULL,
  `id_area` int(10) unsigned NOT NULL,
  `id_categoria` int(10) unsigned NOT NULL,
  `id_fabricante` int(10) unsigned NOT NULL,
  `id_condicion` int(10) unsigned NOT NULL,
  `id_estado` int(10) unsigned NOT NULL,
  `id_proveedor` int(10) unsigned NOT NULL,
  `id_documento` int(10) unsigned DEFAULT NULL,
  `id_sede` int(10) unsigned DEFAULT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_area` (`id_area`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_fabricante` (`id_fabricante`),
  KEY `id_condicion` (`id_condicion`),
  KEY `id_estado` (`id_estado`),
  KEY `id_modelo` (`id_modelo`),
  KEY `id_proveedor` (`id_proveedor`),
  KEY `id_documento` (`id_documento`),
  KEY `id_sede` (`id_sede`),
  CONSTRAINT `tbl_accesorios_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `tbl_areas` (`id`),
  CONSTRAINT `tbl_accesorios_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categorias` (`id`),
  CONSTRAINT `tbl_accesorios_ibfk_3` FOREIGN KEY (`id_fabricante`) REFERENCES `tbl_fabricantes` (`id`),
  CONSTRAINT `tbl_accesorios_ibfk_4` FOREIGN KEY (`id_condicion`) REFERENCES `tbl_condiciones` (`id`),
  CONSTRAINT `tbl_accesorios_ibfk_5` FOREIGN KEY (`id_estado`) REFERENCES `tbl_estados` (`id`),
  CONSTRAINT `tbl_accesorios_ibfk_6` FOREIGN KEY (`id_modelo`) REFERENCES `tbl_modelos` (`id`),
  CONSTRAINT `tbl_accesorios_ibfk_7` FOREIGN KEY (`id_proveedor`) REFERENCES `tbl_proveedores` (`id`),
  CONSTRAINT `tbl_accesorios_ibfk_8` FOREIGN KEY (`id_documento`) REFERENCES `tbl_documentos` (`id`),
  CONSTRAINT `tbl_accesorios_ibfk_9` FOREIGN KEY (`id_sede`) REFERENCES `tbl_sedes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_accesorios: ~0 rows (aproximadamente)
DELETE FROM `tbl_accesorios`;

-- Volcando estructura para tabla sys_inventario_transber.tbl_adjuntos
CREATE TABLE IF NOT EXISTS `tbl_adjuntos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adjunto` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_adjuntos: ~0 rows (aproximadamente)
DELETE FROM `tbl_adjuntos`;

-- Volcando estructura para tabla sys_inventario_transber.tbl_areas
CREATE TABLE IF NOT EXISTS `tbl_areas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `area` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_areas: ~1 rows (aproximadamente)
DELETE FROM `tbl_areas`;
INSERT INTO `tbl_areas` (`id`, `area`) VALUES
	(1, 'sistemas');

-- Volcando estructura para tabla sys_inventario_transber.tbl_asignaciones
CREATE TABLE IF NOT EXISTS `tbl_asignaciones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL,
  `id_celular` int(10) unsigned DEFAULT NULL,
  `id_desk_lap` int(10) unsigned DEFAULT NULL,
  `id_accesorios_mouse` int(10) unsigned DEFAULT NULL,
  `id_accesorios_teclado` int(10) unsigned DEFAULT NULL,
  `observacion` varchar(255) DEFAULT NULL,
  `fecha_asignacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_entrega` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_celular` (`id_celular`),
  KEY `id_desk_lap` (`id_desk_lap`),
  KEY `id_accesorios_mouse` (`id_accesorios_mouse`),
  KEY `id_accesorios_teclado` (`id_accesorios_teclado`),
  KEY `id_entrega` (`id_entrega`),
  CONSTRAINT `tbl_asignaciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id`),
  CONSTRAINT `tbl_asignaciones_ibfk_2` FOREIGN KEY (`id_celular`) REFERENCES `tbl_celulares` (`id`),
  CONSTRAINT `tbl_asignaciones_ibfk_3` FOREIGN KEY (`id_desk_lap`) REFERENCES `tbl_desk_lap` (`id`),
  CONSTRAINT `tbl_asignaciones_ibfk_4` FOREIGN KEY (`id_accesorios_mouse`) REFERENCES `tbl_accesorios` (`id`),
  CONSTRAINT `tbl_asignaciones_ibfk_5` FOREIGN KEY (`id_accesorios_teclado`) REFERENCES `tbl_accesorios` (`id`),
  CONSTRAINT `tbl_asignaciones_ibfk_6` FOREIGN KEY (`id_entrega`) REFERENCES `tbl_entregas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_asignaciones: ~0 rows (aproximadamente)
DELETE FROM `tbl_asignaciones`;

-- Volcando estructura para tabla sys_inventario_transber.tbl_categorias
CREATE TABLE IF NOT EXISTS `tbl_categorias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categoria` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_categorias: ~3 rows (aproximadamente)
DELETE FROM `tbl_categorias`;
INSERT INTO `tbl_categorias` (`id`, `categoria`) VALUES
	(1, 'laptop'),
	(2, 'desktop'),
	(3, 'impresora');

-- Volcando estructura para tabla sys_inventario_transber.tbl_celulares
CREATE TABLE IF NOT EXISTS `tbl_celulares` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_modelo` int(10) unsigned NOT NULL,
  `imei` varchar(255) NOT NULL,
  `numero` varchar(150) DEFAULT NULL,
  `id_sede` int(10) unsigned NOT NULL,
  `id_categoria` int(10) unsigned NOT NULL,
  `id_fabricante` int(10) unsigned NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  `id_condicion` int(10) unsigned NOT NULL,
  `id_estado` int(10) unsigned NOT NULL,
  `id_proveedor` int(10) unsigned NOT NULL,
  `id_documento` int(10) unsigned DEFAULT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_entrega` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_fabricante` (`id_fabricante`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_condicion` (`id_condicion`),
  KEY `id_estado` (`id_estado`),
  KEY `id_modelo` (`id_modelo`),
  KEY `id_proveedor` (`id_proveedor`),
  KEY `id_documento` (`id_documento`),
  KEY `id_sede` (`id_sede`),
  CONSTRAINT `tbl_celulares_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categorias` (`id`),
  CONSTRAINT `tbl_celulares_ibfk_2` FOREIGN KEY (`id_fabricante`) REFERENCES `tbl_fabricantes` (`id`),
  CONSTRAINT `tbl_celulares_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id`),
  CONSTRAINT `tbl_celulares_ibfk_4` FOREIGN KEY (`id_condicion`) REFERENCES `tbl_condiciones` (`id`),
  CONSTRAINT `tbl_celulares_ibfk_5` FOREIGN KEY (`id_estado`) REFERENCES `tbl_estados` (`id`),
  CONSTRAINT `tbl_celulares_ibfk_6` FOREIGN KEY (`id_modelo`) REFERENCES `tbl_modelos` (`id`),
  CONSTRAINT `tbl_celulares_ibfk_7` FOREIGN KEY (`id_proveedor`) REFERENCES `tbl_proveedores` (`id`),
  CONSTRAINT `tbl_celulares_ibfk_8` FOREIGN KEY (`id_documento`) REFERENCES `tbl_documentos` (`id`),
  CONSTRAINT `tbl_celulares_ibfk_9` FOREIGN KEY (`id_sede`) REFERENCES `tbl_sedes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_celulares: ~0 rows (aproximadamente)
DELETE FROM `tbl_celulares`;

-- Volcando estructura para tabla sys_inventario_transber.tbl_centro_costo
CREATE TABLE IF NOT EXISTS `tbl_centro_costo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `centro_costo` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_centro_costo: ~3 rows (aproximadamente)
DELETE FROM `tbl_centro_costo`;
INSERT INTO `tbl_centro_costo` (`id`, `centro_costo`) VALUES
	(1, 'sistemas'),
	(2, 'cna');

-- Volcando estructura para tabla sys_inventario_transber.tbl_condiciones
CREATE TABLE IF NOT EXISTS `tbl_condiciones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `condicion` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_condiciones: ~0 rows (aproximadamente)
DELETE FROM `tbl_condiciones`;

-- Volcando estructura para tabla sys_inventario_transber.tbl_desk_lap
CREATE TABLE IF NOT EXISTS `tbl_desk_lap` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_sede` int(10) unsigned NOT NULL,
  `id_usuario` int(10) unsigned DEFAULT NULL,
  `nom_equipo` varchar(150) DEFAULT NULL,
  `id_categoria` int(10) unsigned DEFAULT NULL,
  `id_centro_costo` int(10) unsigned DEFAULT NULL,
  `id_area` int(10) unsigned DEFAULT NULL,
  `id_fabricante` int(10) unsigned DEFAULT NULL,
  `ns` varchar(150) DEFAULT NULL,
  `procesador` varchar(255) DEFAULT NULL,
  `id_proveedor` int(10) unsigned NOT NULL,
  `mac_ethernet` varchar(50) DEFAULT NULL,
  `mac_wireless` varchar(255) DEFAULT NULL,
  `disco` varchar(255) DEFAULT NULL,
  `memoria` varchar(255) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `numero_part` varchar(255) DEFAULT NULL,
  `adjunto` varchar(255) DEFAULT NULL,
  `id_condicion` int(10) unsigned DEFAULT NULL,
  `id_estado` int(10) unsigned DEFAULT NULL,
  `id_modelo` int(10) unsigned DEFAULT NULL,
  `id_documento` int(10) unsigned DEFAULT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_entrega` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sede` (`id_sede`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_centro_costo` (`id_centro_costo`),
  KEY `id_area` (`id_area`),
  KEY `id_fabricante` (`id_fabricante`),
  KEY `id_condicion` (`id_condicion`),
  KEY `id_estado` (`id_estado`),
  KEY `id_modelo` (`id_modelo`),
  KEY `id_proveedor` (`id_proveedor`),
  KEY `id_documento` (`id_documento`),
  CONSTRAINT `tbl_desk_lap_ibfk_1` FOREIGN KEY (`id_sede`) REFERENCES `tbl_sedes` (`id`),
  CONSTRAINT `tbl_desk_lap_ibfk_10` FOREIGN KEY (`id_proveedor`) REFERENCES `tbl_proveedores` (`id`),
  CONSTRAINT `tbl_desk_lap_ibfk_11` FOREIGN KEY (`id_documento`) REFERENCES `tbl_documentos` (`id`),
  CONSTRAINT `tbl_desk_lap_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id`),
  CONSTRAINT `tbl_desk_lap_ibfk_3` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categorias` (`id`),
  CONSTRAINT `tbl_desk_lap_ibfk_4` FOREIGN KEY (`id_centro_costo`) REFERENCES `tbl_centro_costo` (`id`),
  CONSTRAINT `tbl_desk_lap_ibfk_5` FOREIGN KEY (`id_area`) REFERENCES `tbl_areas` (`id`),
  CONSTRAINT `tbl_desk_lap_ibfk_6` FOREIGN KEY (`id_fabricante`) REFERENCES `tbl_fabricantes` (`id`),
  CONSTRAINT `tbl_desk_lap_ibfk_7` FOREIGN KEY (`id_condicion`) REFERENCES `tbl_condiciones` (`id`),
  CONSTRAINT `tbl_desk_lap_ibfk_8` FOREIGN KEY (`id_estado`) REFERENCES `tbl_estados` (`id`),
  CONSTRAINT `tbl_desk_lap_ibfk_9` FOREIGN KEY (`id_modelo`) REFERENCES `tbl_modelos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_desk_lap: ~0 rows (aproximadamente)
DELETE FROM `tbl_desk_lap`;

-- Volcando estructura para tabla sys_inventario_transber.tbl_documentos
CREATE TABLE IF NOT EXISTS `tbl_documentos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `documento` varchar(255) NOT NULL,
  `id_adjunto` int(10) unsigned NOT NULL,
  `ruta_adjunto` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_inicio` timestamp NULL DEFAULT NULL,
  `fecha_termino` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_adjunto` (`id_adjunto`),
  CONSTRAINT `tbl_documentos_ibfk_1` FOREIGN KEY (`id_adjunto`) REFERENCES `tbl_adjuntos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_documentos: ~0 rows (aproximadamente)
DELETE FROM `tbl_documentos`;

-- Volcando estructura para tabla sys_inventario_transber.tbl_entregas
CREATE TABLE IF NOT EXISTS `tbl_entregas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entrega` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_entregas: ~0 rows (aproximadamente)
DELETE FROM `tbl_entregas`;

-- Volcando estructura para tabla sys_inventario_transber.tbl_estados
CREATE TABLE IF NOT EXISTS `tbl_estados` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `estado` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_estados: ~0 rows (aproximadamente)
DELETE FROM `tbl_estados`;

-- Volcando estructura para tabla sys_inventario_transber.tbl_fabricantes
CREATE TABLE IF NOT EXISTS `tbl_fabricantes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fabricante` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_fabricantes: ~2 rows (aproximadamente)
DELETE FROM `tbl_fabricantes`;
INSERT INTO `tbl_fabricantes` (`id`, `fabricante`) VALUES
	(1, 'hp'),
	(2, 'lenovo');

-- Volcando estructura para tabla sys_inventario_transber.tbl_historial_activos
CREATE TABLE IF NOT EXISTS `tbl_historial_activos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_asignacion` int(10) unsigned NOT NULL,
  `id_usuario_anterior` int(10) unsigned NOT NULL,
  `id_usuario_nuevo` int(10) unsigned NOT NULL,
  `id_condicion` int(10) unsigned NOT NULL,
  `id_centro_costo_anterior` int(10) unsigned DEFAULT NULL,
  `id_centro_costo_nuevo` int(10) unsigned DEFAULT NULL,
  `fecha_movimiento` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `observacion` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_asignacion` (`id_asignacion`),
  KEY `id_usuario_anterior` (`id_usuario_anterior`),
  KEY `id_usuario_nuevo` (`id_usuario_nuevo`),
  KEY `id_condicion` (`id_condicion`),
  KEY `id_centro_costo_anterior` (`id_centro_costo_anterior`),
  KEY `id_centro_costo_nuevo` (`id_centro_costo_nuevo`),
  CONSTRAINT `tbl_historial_activos_ibfk_1` FOREIGN KEY (`id_asignacion`) REFERENCES `tbl_asignaciones` (`id`),
  CONSTRAINT `tbl_historial_activos_ibfk_2` FOREIGN KEY (`id_usuario_anterior`) REFERENCES `tbl_usuarios` (`id`),
  CONSTRAINT `tbl_historial_activos_ibfk_3` FOREIGN KEY (`id_usuario_nuevo`) REFERENCES `tbl_usuarios` (`id`),
  CONSTRAINT `tbl_historial_activos_ibfk_4` FOREIGN KEY (`id_condicion`) REFERENCES `tbl_condiciones` (`id`),
  CONSTRAINT `tbl_historial_activos_ibfk_5` FOREIGN KEY (`id_centro_costo_anterior`) REFERENCES `tbl_centro_costo` (`id`),
  CONSTRAINT `tbl_historial_activos_ibfk_6` FOREIGN KEY (`id_centro_costo_nuevo`) REFERENCES `tbl_centro_costo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_historial_activos: ~0 rows (aproximadamente)
DELETE FROM `tbl_historial_activos`;

-- Volcando estructura para tabla sys_inventario_transber.tbl_impresoras
CREATE TABLE IF NOT EXISTS `tbl_impresoras` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_area` int(10) unsigned NOT NULL,
  `id_categoria` int(10) unsigned NOT NULL,
  `id_modelo` int(10) unsigned NOT NULL,
  `id_sede` int(10) unsigned NOT NULL,
  `id_fabricante` int(10) unsigned NOT NULL,
  `id_proveedor` int(10) unsigned NOT NULL,
  `ip` varchar(150) NOT NULL,
  `ns` varchar(255) NOT NULL,
  `id_estado` int(10) unsigned NOT NULL,
  `id_documento` int(10) unsigned DEFAULT NULL,
  `propietario` varchar(150) NOT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_entrega` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_area` (`id_area`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_fabricante` (`id_fabricante`),
  KEY `id_modelo` (`id_modelo`),
  KEY `id_estado` (`id_estado`),
  KEY `id_proveedor` (`id_proveedor`),
  KEY `id_documento` (`id_documento`),
  KEY `id_sede` (`id_sede`),
  CONSTRAINT `tbl_impresoras_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `tbl_areas` (`id`),
  CONSTRAINT `tbl_impresoras_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categorias` (`id`),
  CONSTRAINT `tbl_impresoras_ibfk_3` FOREIGN KEY (`id_fabricante`) REFERENCES `tbl_fabricantes` (`id`),
  CONSTRAINT `tbl_impresoras_ibfk_4` FOREIGN KEY (`id_modelo`) REFERENCES `tbl_modelos` (`id`),
  CONSTRAINT `tbl_impresoras_ibfk_5` FOREIGN KEY (`id_estado`) REFERENCES `tbl_estados` (`id`),
  CONSTRAINT `tbl_impresoras_ibfk_6` FOREIGN KEY (`id_proveedor`) REFERENCES `tbl_proveedores` (`id`),
  CONSTRAINT `tbl_impresoras_ibfk_7` FOREIGN KEY (`id_documento`) REFERENCES `tbl_documentos` (`id`),
  CONSTRAINT `tbl_impresoras_ibfk_8` FOREIGN KEY (`id_sede`) REFERENCES `tbl_sedes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_impresoras: ~0 rows (aproximadamente)
DELETE FROM `tbl_impresoras`;

-- Volcando estructura para tabla sys_inventario_transber.tbl_infraestructura
CREATE TABLE IF NOT EXISTS `tbl_infraestructura` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(150) DEFAULT NULL,
  `ns` varchar(255) NOT NULL,
  `dns` varchar(150) DEFAULT NULL,
  `enlace` varchar(150) DEFAULT NULL,
  `mac` varchar(150) DEFAULT NULL,
  `id_sede` int(10) unsigned NOT NULL,
  `id_proveedor` int(10) unsigned NOT NULL,
  `id_modelo` int(10) unsigned NOT NULL,
  `id_area` int(10) unsigned NOT NULL,
  `id_categoria` int(10) unsigned NOT NULL,
  `id_fabricante` int(10) unsigned NOT NULL,
  `id_condicion` int(10) unsigned NOT NULL,
  `id_estado` int(10) unsigned NOT NULL,
  `id_documento` int(10) unsigned DEFAULT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_area` (`id_area`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_fabricante` (`id_fabricante`),
  KEY `id_condicion` (`id_condicion`),
  KEY `id_estado` (`id_estado`),
  KEY `id_modelo` (`id_modelo`),
  KEY `id_proveedor` (`id_proveedor`),
  KEY `id_documento` (`id_documento`),
  KEY `id_sede` (`id_sede`),
  CONSTRAINT `tbl_infraestructura_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `tbl_areas` (`id`),
  CONSTRAINT `tbl_infraestructura_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categorias` (`id`),
  CONSTRAINT `tbl_infraestructura_ibfk_3` FOREIGN KEY (`id_fabricante`) REFERENCES `tbl_fabricantes` (`id`),
  CONSTRAINT `tbl_infraestructura_ibfk_4` FOREIGN KEY (`id_condicion`) REFERENCES `tbl_condiciones` (`id`),
  CONSTRAINT `tbl_infraestructura_ibfk_5` FOREIGN KEY (`id_estado`) REFERENCES `tbl_estados` (`id`),
  CONSTRAINT `tbl_infraestructura_ibfk_6` FOREIGN KEY (`id_modelo`) REFERENCES `tbl_modelos` (`id`),
  CONSTRAINT `tbl_infraestructura_ibfk_7` FOREIGN KEY (`id_proveedor`) REFERENCES `tbl_proveedores` (`id`),
  CONSTRAINT `tbl_infraestructura_ibfk_8` FOREIGN KEY (`id_documento`) REFERENCES `tbl_documentos` (`id`),
  CONSTRAINT `tbl_infraestructura_ibfk_9` FOREIGN KEY (`id_sede`) REFERENCES `tbl_sedes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_infraestructura: ~0 rows (aproximadamente)
DELETE FROM `tbl_infraestructura`;

-- Volcando estructura para tabla sys_inventario_transber.tbl_licencias
CREATE TABLE IF NOT EXISTS `tbl_licencias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `software` varchar(255) NOT NULL,
  `version` varchar(255) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `tipo` varchar(150) NOT NULL,
  `id_proveedor` int(10) unsigned DEFAULT NULL,
  `id_documento` int(10) unsigned DEFAULT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_asignacion` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_proveedor` (`id_proveedor`),
  KEY `id_documento` (`id_documento`),
  CONSTRAINT `tbl_licencias_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `tbl_proveedores` (`id`),
  CONSTRAINT `tbl_licencias_ibfk_2` FOREIGN KEY (`id_documento`) REFERENCES `tbl_documentos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_licencias: ~0 rows (aproximadamente)
DELETE FROM `tbl_licencias`;

-- Volcando estructura para tabla sys_inventario_transber.tbl_licencias_asignada
CREATE TABLE IF NOT EXISTS `tbl_licencias_asignada` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_desk_lap` int(10) unsigned NOT NULL,
  `id_licencia` int(10) unsigned NOT NULL,
  `fecha_asignacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_desk_lap` (`id_desk_lap`),
  KEY `id_licencia` (`id_licencia`),
  CONSTRAINT `tbl_licencias_asignada_ibfk_1` FOREIGN KEY (`id_desk_lap`) REFERENCES `tbl_desk_lap` (`id`),
  CONSTRAINT `tbl_licencias_asignada_ibfk_2` FOREIGN KEY (`id_licencia`) REFERENCES `tbl_licencias` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_licencias_asignada: ~0 rows (aproximadamente)
DELETE FROM `tbl_licencias_asignada`;

-- Volcando estructura para tabla sys_inventario_transber.tbl_mantenimientos
CREATE TABLE IF NOT EXISTS `tbl_mantenimientos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_desk_lap` int(10) unsigned NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `observacion` varchar(255) NOT NULL,
  `fecha_inicio` timestamp NULL DEFAULT NULL,
  `fecha_fin` timestamp NULL DEFAULT NULL,
  `realizado_por` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_desk_lap` (`id_desk_lap`),
  CONSTRAINT `tbl_mantenimientos_ibfk_1` FOREIGN KEY (`id_desk_lap`) REFERENCES `tbl_desk_lap` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_mantenimientos: ~0 rows (aproximadamente)
DELETE FROM `tbl_mantenimientos`;

-- Volcando estructura para tabla sys_inventario_transber.tbl_modelos
CREATE TABLE IF NOT EXISTS `tbl_modelos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modelo` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_modelos: ~0 rows (aproximadamente)
DELETE FROM `tbl_modelos`;
INSERT INTO `tbl_modelos` (`id`, `modelo`) VALUES
	(1, 'think pad'),
	(2, 'gamer thinkk');

-- Volcando estructura para tabla sys_inventario_transber.tbl_perfiles
CREATE TABLE IF NOT EXISTS `tbl_perfiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `perfil` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_perfiles: ~2 rows (aproximadamente)
DELETE FROM `tbl_perfiles`;
INSERT INTO `tbl_perfiles` (`id`, `perfil`) VALUES
	(1, 'usuario'),
	(2, 'administrador');

-- Volcando estructura para tabla sys_inventario_transber.tbl_productos
CREATE TABLE IF NOT EXISTS `tbl_productos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `producto` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_productos: ~0 rows (aproximadamente)
DELETE FROM `tbl_productos`;
INSERT INTO `tbl_productos` (`id`, `producto`) VALUES
	(1, 'servicios'),
	(2, 'activos');

-- Volcando estructura para tabla sys_inventario_transber.tbl_proveedores
CREATE TABLE IF NOT EXISTS `tbl_proveedores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `proveedor` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `contacto` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telefono` varchar(150) NOT NULL,
  `id_producto` int(10) unsigned DEFAULT NULL,
  `id_documento` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_producto` (`id_producto`),
  KEY `id_documento` (`id_documento`),
  CONSTRAINT `tbl_proveedores_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `tbl_productos` (`id`),
  CONSTRAINT `tbl_proveedores_ibfk_2` FOREIGN KEY (`id_documento`) REFERENCES `tbl_documentos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_proveedores: ~0 rows (aproximadamente)
DELETE FROM `tbl_proveedores`;
INSERT INTO `tbl_proveedores` (`id`, `proveedor`, `direccion`, `contacto`, `email`, `telefono`, `id_producto`, `id_documento`) VALUES
	(1, 'digital', 'jr digital 123', 'alberto', 'alberto@gmail.com', '987456123', 1, NULL);

-- Volcando estructura para tabla sys_inventario_transber.tbl_sedes
CREATE TABLE IF NOT EXISTS `tbl_sedes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sede` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_sedes: ~9 rows (aproximadamente)
DELETE FROM `tbl_sedes`;
INSERT INTO `tbl_sedes` (`id`, `sede`) VALUES
	(1, 'arequipa'),
	(2, 'callao'),
	(3, 'independencia'),
	(4, 'cuzco'),
	(5, 'iquitos morona'),
	(6, 'iquitos aereopuerto'),
	(7, 'oquendo'),
	(8, 'pucallpa'),
	(9, 'san isidro'),
	(10, 'tarapoto'),
	(11, 'ventanilla');

-- Volcando estructura para tabla sys_inventario_transber.tbl_usuarios
CREATE TABLE IF NOT EXISTS `tbl_usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) NOT NULL,
  `usuario_red` varchar(255) NOT NULL,
  `contrasena` varchar(150) DEFAULT NULL,
  `id_centro_costo` int(10) unsigned NOT NULL,
  `cargo` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `id_sede` int(10) unsigned NOT NULL,
  `id_perfil` int(10) unsigned NOT NULL,
  `id_area` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_centro_costo` (`id_centro_costo`),
  KEY `id_sede` (`id_sede`),
  KEY `id_perfil` (`id_perfil`),
  KEY `tbl_usuarios_ibfk_4` (`id_area`),
  CONSTRAINT `tbl_usuarios_ibfk_1` FOREIGN KEY (`id_centro_costo`) REFERENCES `tbl_centro_costo` (`id`),
  CONSTRAINT `tbl_usuarios_ibfk_2` FOREIGN KEY (`id_sede`) REFERENCES `tbl_sedes` (`id`),
  CONSTRAINT `tbl_usuarios_ibfk_3` FOREIGN KEY (`id_perfil`) REFERENCES `tbl_perfiles` (`id`),
  CONSTRAINT `tbl_usuarios_ibfk_4` FOREIGN KEY (`id_area`) REFERENCES `tbl_areas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_usuarios: ~2 rows (aproximadamente)
DELETE FROM `tbl_usuarios`;
INSERT INTO `tbl_usuarios` (`id`, `usuario`, `usuario_red`, `contrasena`, `id_centro_costo`, `cargo`, `email`, `id_sede`, `id_perfil`, `id_area`) VALUES
	(1, 'Kevin Torres', 'ktorres', '1234', 1, 'auxiliar de sistemas', 'ktorres@transberperu.com', 2, 2, 1),
	(11, 'Sergio Ventura Maco', 'sventura', '1234', 1, 'Auxiliar de Sistemas', 'sventura@transberperu.com', 2, 1, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
