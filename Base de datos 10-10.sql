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
  `nombre` varchar(255) NOT NULL,
  `ns` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_categoria` int(10) unsigned NOT NULL,
  `id_fabricante` int(10) unsigned NOT NULL,
  `id_condicion` int(10) unsigned NOT NULL,
  `id_estado` int(10) unsigned NOT NULL,
  `id_proveedor` int(10) unsigned NOT NULL,
  `id_documento` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_fabricante` (`id_fabricante`),
  KEY `id_condicion` (`id_condicion`),
  KEY `id_estado` (`id_estado`),
  KEY `id_proveedor` (`id_proveedor`),
  KEY `id_documento` (`id_documento`),
  CONSTRAINT `tbl_accesorios_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categorias` (`id`),
  CONSTRAINT `tbl_accesorios_ibfk_2` FOREIGN KEY (`id_fabricante`) REFERENCES `tbl_fabricantes` (`id`),
  CONSTRAINT `tbl_accesorios_ibfk_3` FOREIGN KEY (`id_condicion`) REFERENCES `tbl_condiciones` (`id`),
  CONSTRAINT `tbl_accesorios_ibfk_4` FOREIGN KEY (`id_estado`) REFERENCES `tbl_estados` (`id`),
  CONSTRAINT `tbl_accesorios_ibfk_5` FOREIGN KEY (`id_proveedor`) REFERENCES `tbl_proveedores` (`id`),
  CONSTRAINT `tbl_accesorios_ibfk_6` FOREIGN KEY (`id_documento`) REFERENCES `tbl_documentos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_accesorios: ~0 rows (aproximadamente)
DELETE FROM `tbl_accesorios`;
INSERT INTO `tbl_accesorios` (`id`, `nombre`, `ns`, `fecha_registro`, `id_categoria`, `id_fabricante`, `id_condicion`, `id_estado`, `id_proveedor`, `id_documento`) VALUES
	(1, 'Teclado', '123456789', '2025-10-15 17:10:51', 3, 8, 1, 1, 1, NULL);

-- Volcando estructura para tabla sys_inventario_transber.tbl_areas
CREATE TABLE IF NOT EXISTS `tbl_areas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `area` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_areas: ~10 rows (aproximadamente)
DELETE FROM `tbl_areas`;
INSERT INTO `tbl_areas` (`id`, `area`) VALUES
	(1, 'Almacen'),
	(2, 'Recursos Humanos'),
	(3, 'Cna'),
	(4, 'Cobranzas'),
	(5, 'Contabilidad'),
	(6, 'Exportaciones'),
	(7, 'Facturacion'),
	(8, 'Importaciones'),
	(9, 'Proyectos'),
	(10, 'Sistemas');

-- Volcando estructura para tabla sys_inventario_transber.tbl_asignaciones
CREATE TABLE IF NOT EXISTS `tbl_asignaciones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL,
  `id_celular` int(10) unsigned DEFAULT NULL,
  `id_desk_lap` int(10) unsigned DEFAULT NULL,
  `observacion` varchar(255) DEFAULT NULL,
  `ruta_adjunto` varchar(255) DEFAULT NULL,
  `fecha_movimiento` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_entrega` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_celular` (`id_celular`),
  KEY `id_desk_lap` (`id_desk_lap`),
  KEY `id_entrega` (`id_entrega`),
  CONSTRAINT `tbl_asignaciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id`),
  CONSTRAINT `tbl_asignaciones_ibfk_2` FOREIGN KEY (`id_celular`) REFERENCES `tbl_celulares` (`id`),
  CONSTRAINT `tbl_asignaciones_ibfk_3` FOREIGN KEY (`id_desk_lap`) REFERENCES `tbl_desk_lap` (`id`),
  CONSTRAINT `tbl_asignaciones_ibfk_4` FOREIGN KEY (`id_entrega`) REFERENCES `tbl_entregas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_asignaciones: ~1 rows (aproximadamente)
DELETE FROM `tbl_asignaciones`;
INSERT INTO `tbl_asignaciones` (`id`, `id_usuario`, `id_celular`, `id_desk_lap`, `observacion`, `ruta_adjunto`, `fecha_movimiento`, `id_entrega`) VALUES
	(1, 1, 1, 1, 'okay', NULL, '2025-10-21 23:20:25', 6);

-- Volcando estructura para tabla sys_inventario_transber.tbl_asignacion_accesorios
CREATE TABLE IF NOT EXISTS `tbl_asignacion_accesorios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_asignacion` int(10) unsigned NOT NULL,
  `id_accesorio` int(10) unsigned NOT NULL,
  `fecha_asignacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_devolucion` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_asignacion` (`id_asignacion`),
  KEY `id_accesorio` (`id_accesorio`),
  CONSTRAINT `tbl_asignacion_accesorios_ibfk_1` FOREIGN KEY (`id_asignacion`) REFERENCES `tbl_asignaciones` (`id`),
  CONSTRAINT `tbl_asignacion_accesorios_ibfk_2` FOREIGN KEY (`id_accesorio`) REFERENCES `tbl_accesorios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_asignacion_accesorios: ~0 rows (aproximadamente)
DELETE FROM `tbl_asignacion_accesorios`;

-- Volcando estructura para tabla sys_inventario_transber.tbl_categorias
CREATE TABLE IF NOT EXISTS `tbl_categorias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categoria` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_categorias: ~6 rows (aproximadamente)
DELETE FROM `tbl_categorias`;
INSERT INTO `tbl_categorias` (`id`, `categoria`) VALUES
	(1, 'Desktop'),
	(2, 'Laptop'),
	(3, 'Accesorio'),
	(4, 'Celular'),
	(5, 'Impresora'),
	(6, 'Infraestructura'),
	(7, 'Licencia');

-- Volcando estructura para tabla sys_inventario_transber.tbl_celulares
CREATE TABLE IF NOT EXISTS `tbl_celulares` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `imei` varchar(255) NOT NULL,
  `numero` varchar(150) DEFAULT NULL,
  `ns` varchar(150) DEFAULT NULL,
  `id_categoria` int(10) unsigned NOT NULL,
  `id_fabricante` int(10) unsigned DEFAULT NULL,
  `id_modelo` int(10) unsigned DEFAULT NULL,
  `id_condicion` int(10) unsigned NOT NULL,
  `id_estado` int(10) unsigned NOT NULL,
  `id_proveedor` int(10) unsigned NOT NULL,
  `id_documento` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_fabricante` (`id_fabricante`),
  KEY `id_modelo` (`id_modelo`),
  KEY `id_condicion` (`id_condicion`),
  KEY `id_estado` (`id_estado`),
  KEY `id_proveedor` (`id_proveedor`),
  KEY `id_documento` (`id_documento`),
  CONSTRAINT `tbl_celulares_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categorias` (`id`),
  CONSTRAINT `tbl_celulares_ibfk_2` FOREIGN KEY (`id_fabricante`) REFERENCES `tbl_fabricantes` (`id`),
  CONSTRAINT `tbl_celulares_ibfk_3` FOREIGN KEY (`id_modelo`) REFERENCES `tbl_modelos` (`id`),
  CONSTRAINT `tbl_celulares_ibfk_4` FOREIGN KEY (`id_condicion`) REFERENCES `tbl_condiciones` (`id`),
  CONSTRAINT `tbl_celulares_ibfk_5` FOREIGN KEY (`id_estado`) REFERENCES `tbl_estados` (`id`),
  CONSTRAINT `tbl_celulares_ibfk_6` FOREIGN KEY (`id_proveedor`) REFERENCES `tbl_proveedores` (`id`),
  CONSTRAINT `tbl_celulares_ibfk_7` FOREIGN KEY (`id_documento`) REFERENCES `tbl_documentos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_celulares: ~0 rows (aproximadamente)
DELETE FROM `tbl_celulares`;
INSERT INTO `tbl_celulares` (`id`, `imei`, `numero`, `ns`, `id_categoria`, `id_fabricante`, `id_modelo`, `id_condicion`, `id_estado`, `id_proveedor`, `id_documento`) VALUES
	(1, '862345060219751', '969547008', 'NBA54PEABB008289', 4, 9, 14, 2, 2, 1, NULL);

-- Volcando estructura para tabla sys_inventario_transber.tbl_centro_costo
CREATE TABLE IF NOT EXISTS `tbl_centro_costo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `centro_costo` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_centro_costo: ~13 rows (aproximadamente)
DELETE FROM `tbl_centro_costo`;
INSERT INTO `tbl_centro_costo` (`id`, `centro_costo`) VALUES
	(1, 'Administración'),
	(2, 'Almacenes'),
	(3, 'CNA'),
	(4, 'Cobranzas'),
	(5, 'Comercial'),
	(6, 'Compras'),
	(7, 'Contabilidad'),
	(8, 'Exportaciones'),
	(9, 'Facturacion'),
	(10, 'Finanzas'),
	(11, 'GAF'),
	(12, 'Gerencia'),
	(13, 'HSE');

-- Volcando estructura para tabla sys_inventario_transber.tbl_condiciones
CREATE TABLE IF NOT EXISTS `tbl_condiciones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `condicion` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_condiciones: ~4 rows (aproximadamente)
DELETE FROM `tbl_condiciones`;
INSERT INTO `tbl_condiciones` (`id`, `condicion`) VALUES
	(1, 'Nuevo'),
	(2, 'Usado'),
	(3, 'En reparación'),
	(4, 'Defectuoso');

-- Volcando estructura para tabla sys_inventario_transber.tbl_desk_lap
CREATE TABLE IF NOT EXISTS `tbl_desk_lap` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom_equipo` varchar(150) DEFAULT NULL,
  `ns` varchar(150) DEFAULT NULL,
  `procesador` varchar(255) DEFAULT NULL,
  `id_proveedor` int(10) unsigned DEFAULT NULL,
  `disco` varchar(255) DEFAULT NULL,
  `memoria` varchar(255) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `numero_part` varchar(255) DEFAULT NULL,
  `fecha_compra` timestamp NULL DEFAULT NULL,
  `fecha_inicio_garantia` timestamp NULL DEFAULT NULL,
  `fecha_fin_garantia` timestamp NULL DEFAULT NULL,
  `fecha_baja` timestamp NULL DEFAULT NULL,
  `id_centro_costo` int(10) unsigned DEFAULT NULL,
  `id_condicion` int(10) unsigned DEFAULT NULL,
  `id_estado` int(10) unsigned DEFAULT NULL,
  `id_categoria` int(10) unsigned DEFAULT NULL,
  `id_fabricante` int(10) unsigned DEFAULT NULL,
  `id_modelo` int(10) unsigned DEFAULT NULL,
  `id_documento` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_centro_costo` (`id_centro_costo`),
  KEY `id_condicion` (`id_condicion`),
  KEY `id_estado` (`id_estado`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_fabricante` (`id_fabricante`),
  KEY `id_modelo` (`id_modelo`),
  KEY `id_proveedor` (`id_proveedor`),
  KEY `id_documento` (`id_documento`),
  CONSTRAINT `tbl_desk_lap_ibfk_1` FOREIGN KEY (`id_centro_costo`) REFERENCES `tbl_centro_costo` (`id`),
  CONSTRAINT `tbl_desk_lap_ibfk_2` FOREIGN KEY (`id_condicion`) REFERENCES `tbl_condiciones` (`id`),
  CONSTRAINT `tbl_desk_lap_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `tbl_estados` (`id`),
  CONSTRAINT `tbl_desk_lap_ibfk_4` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categorias` (`id`),
  CONSTRAINT `tbl_desk_lap_ibfk_5` FOREIGN KEY (`id_fabricante`) REFERENCES `tbl_fabricantes` (`id`),
  CONSTRAINT `tbl_desk_lap_ibfk_6` FOREIGN KEY (`id_modelo`) REFERENCES `tbl_modelos` (`id`),
  CONSTRAINT `tbl_desk_lap_ibfk_7` FOREIGN KEY (`id_proveedor`) REFERENCES `tbl_proveedores` (`id`),
  CONSTRAINT `tbl_desk_lap_ibfk_8` FOREIGN KEY (`id_documento`) REFERENCES `tbl_documentos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_desk_lap: ~0 rows (aproximadamente)
DELETE FROM `tbl_desk_lap`;
INSERT INTO `tbl_desk_lap` (`id`, `nom_equipo`, `ns`, `procesador`, `id_proveedor`, `disco`, `memoria`, `ip`, `numero_part`, `fecha_compra`, `fecha_inicio_garantia`, `fecha_fin_garantia`, `fecha_baja`, `id_centro_costo`, `id_condicion`, `id_estado`, `id_categoria`, `id_fabricante`, `id_modelo`, `id_documento`) VALUES
	(1, 'TBCACNA002', 'MJ0D84HG', 'CORE i5', 1, '512GB SSD', '16GB', '172.16.110.1', 'MJ0D84HG', '2025-10-13 05:00:00', NULL, NULL, NULL, 3, 1, 2, 1, 7, 13, NULL);

-- Volcando estructura para tabla sys_inventario_transber.tbl_documentos
CREATE TABLE IF NOT EXISTS `tbl_documentos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `id_tipo_adjunto` int(10) unsigned DEFAULT NULL,
  `ruta_adjunto` varchar(255) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_inicio` timestamp NULL DEFAULT NULL,
  `fecha_termino` timestamp NULL DEFAULT NULL,
  `id_producto` int(10) unsigned DEFAULT NULL,
  `id_proveedor` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo_adjunto` (`id_tipo_adjunto`),
  KEY `id_producto` (`id_producto`),
  KEY `id_proveedor` (`id_proveedor`),
  CONSTRAINT `tbl_documentos_ibfk_1` FOREIGN KEY (`id_tipo_adjunto`) REFERENCES `tbl_tipo_adjuntos` (`id`),
  CONSTRAINT `tbl_documentos_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `tbl_productos` (`id`),
  CONSTRAINT `tbl_documentos_ibfk_3` FOREIGN KEY (`id_proveedor`) REFERENCES `tbl_proveedores` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_documentos: ~0 rows (aproximadamente)
DELETE FROM `tbl_documentos`;

-- Volcando estructura para tabla sys_inventario_transber.tbl_entregas
CREATE TABLE IF NOT EXISTS `tbl_entregas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entrega` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_entregas: ~4 rows (aproximadamente)
DELETE FROM `tbl_entregas`;
INSERT INTO `tbl_entregas` (`id`, `entrega`) VALUES
	(1, 'Asignación Celular'),
	(2, 'Préstamo'),
	(3, 'Devolución Completa'),
	(4, 'Reasignación'),
	(5, 'Asignación Desktop o Laptop'),
	(6, 'Asignación Completa');

-- Volcando estructura para tabla sys_inventario_transber.tbl_estados
CREATE TABLE IF NOT EXISTS `tbl_estados` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `estado` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_estados: ~4 rows (aproximadamente)
DELETE FROM `tbl_estados`;
INSERT INTO `tbl_estados` (`id`, `estado`) VALUES
	(1, 'Disponible'),
	(2, 'Asignado'),
	(3, 'En mantenimiento'),
	(4, 'Dado de baja');

-- Volcando estructura para tabla sys_inventario_transber.tbl_fabricantes
CREATE TABLE IF NOT EXISTS `tbl_fabricantes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fabricante` varchar(150) NOT NULL,
  `id_categoria` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `tbl_fabricantes_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_fabricantes: ~10 rows (aproximadamente)
DELETE FROM `tbl_fabricantes`;
INSERT INTO `tbl_fabricantes` (`id`, `fabricante`, `id_categoria`) VALUES
	(1, 'Lenovo', 2),
	(2, 'HP', 2),
	(3, 'Apple', 4),
	(4, 'Samsung', 4),
	(5, 'Canon', 5),
	(6, 'Epson', 5),
	(7, 'Lenovo', 1),
	(8, 'Generico', 3),
	(9, 'ZTE', 4),
	(11, 'Xerox', 5);

-- Volcando estructura para tabla sys_inventario_transber.tbl_historial_activos
CREATE TABLE IF NOT EXISTS `tbl_historial_activos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_asignacion` int(10) unsigned NOT NULL,
  `id_usuario_anterior` int(10) unsigned DEFAULT NULL,
  `id_usuario_nuevo` int(10) unsigned DEFAULT NULL,
  `tipo_activo` enum('DeskLap','Celular','Accesorio') NOT NULL,
  `id_entrega` int(10) unsigned DEFAULT NULL,
  `fecha_movimiento` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_asignacion` (`id_asignacion`),
  KEY `id_usuario_anterior` (`id_usuario_anterior`),
  KEY `id_usuario_nuevo` (`id_usuario_nuevo`),
  KEY `id_entrega` (`id_entrega`),
  CONSTRAINT `tbl_historial_activos_ibfk_1` FOREIGN KEY (`id_asignacion`) REFERENCES `tbl_asignaciones` (`id`),
  CONSTRAINT `tbl_historial_activos_ibfk_2` FOREIGN KEY (`id_usuario_anterior`) REFERENCES `tbl_usuarios` (`id`),
  CONSTRAINT `tbl_historial_activos_ibfk_3` FOREIGN KEY (`id_usuario_nuevo`) REFERENCES `tbl_usuarios` (`id`),
  CONSTRAINT `tbl_historial_activos_ibfk_4` FOREIGN KEY (`id_entrega`) REFERENCES `tbl_entregas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_historial_activos: ~0 rows (aproximadamente)
DELETE FROM `tbl_historial_activos`;

-- Volcando estructura para tabla sys_inventario_transber.tbl_impresoras
CREATE TABLE IF NOT EXISTS `tbl_impresoras` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(150) DEFAULT NULL,
  `ns` varchar(255) DEFAULT NULL,
  `fecha_compra` timestamp NULL DEFAULT NULL,
  `fecha_instalacion` timestamp NULL DEFAULT NULL,
  `fecha_retiro` timestamp NULL DEFAULT NULL,
  `id_categoria` int(10) unsigned DEFAULT NULL,
  `id_fabricante` int(10) unsigned NOT NULL,
  `id_modelo` int(10) unsigned NOT NULL,
  `id_area` int(10) unsigned DEFAULT NULL,
  `id_sede` int(10) unsigned DEFAULT NULL,
  `id_estado` int(10) unsigned NOT NULL,
  `id_condicion` int(10) unsigned DEFAULT NULL,
  `id_proveedor` int(10) unsigned NOT NULL,
  `id_documento` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_area` (`id_area`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_fabricante` (`id_fabricante`),
  KEY `id_modelo` (`id_modelo`),
  KEY `id_estado` (`id_estado`),
  KEY `id_condicion` (`id_condicion`),
  KEY `id_proveedor` (`id_proveedor`),
  KEY `id_documento` (`id_documento`),
  KEY `id_sede` (`id_sede`),
  CONSTRAINT `tbl_impresoras_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `tbl_areas` (`id`),
  CONSTRAINT `tbl_impresoras_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categorias` (`id`),
  CONSTRAINT `tbl_impresoras_ibfk_3` FOREIGN KEY (`id_fabricante`) REFERENCES `tbl_fabricantes` (`id`),
  CONSTRAINT `tbl_impresoras_ibfk_4` FOREIGN KEY (`id_modelo`) REFERENCES `tbl_modelos` (`id`),
  CONSTRAINT `tbl_impresoras_ibfk_5` FOREIGN KEY (`id_estado`) REFERENCES `tbl_estados` (`id`),
  CONSTRAINT `tbl_impresoras_ibfk_6` FOREIGN KEY (`id_condicion`) REFERENCES `tbl_condiciones` (`id`),
  CONSTRAINT `tbl_impresoras_ibfk_7` FOREIGN KEY (`id_proveedor`) REFERENCES `tbl_proveedores` (`id`),
  CONSTRAINT `tbl_impresoras_ibfk_8` FOREIGN KEY (`id_documento`) REFERENCES `tbl_documentos` (`id`),
  CONSTRAINT `tbl_impresoras_ibfk_9` FOREIGN KEY (`id_sede`) REFERENCES `tbl_sedes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_impresoras: ~0 rows (aproximadamente)
DELETE FROM `tbl_impresoras`;
INSERT INTO `tbl_impresoras` (`id`, `ip`, `ns`, `fecha_compra`, `fecha_instalacion`, `fecha_retiro`, `id_categoria`, `id_fabricante`, `id_modelo`, `id_area`, `id_sede`, `id_estado`, `id_condicion`, `id_proveedor`, `id_documento`) VALUES
	(1, '172.16.110.4', '3353283145', '2025-10-16 05:00:00', NULL, NULL, 5, 11, 15, NULL, NULL, 2, 2, 1, NULL);

-- Volcando estructura para tabla sys_inventario_transber.tbl_infraestructura
CREATE TABLE IF NOT EXISTS `tbl_infraestructura` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(150) DEFAULT NULL,
  `ns` varchar(255) NOT NULL,
  `dns` varchar(150) DEFAULT NULL,
  `enlace` varchar(150) DEFAULT NULL,
  `mac` varchar(150) DEFAULT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_area` int(10) unsigned NOT NULL,
  `id_sede` int(10) unsigned NOT NULL,
  `id_categoria` int(10) unsigned NOT NULL,
  `id_fabricante` int(10) unsigned NOT NULL,
  `id_modelo` int(10) unsigned NOT NULL,
  `id_condicion` int(10) unsigned NOT NULL,
  `id_estado` int(10) unsigned NOT NULL,
  `id_proveedor` int(10) unsigned NOT NULL,
  `id_documento` int(10) unsigned DEFAULT NULL,
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
  `nro_version` varchar(255) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `tipo` varchar(150) NOT NULL,
  `fecha_inicio_licencia` timestamp NULL DEFAULT NULL,
  `fecha_fin_licencia` timestamp NULL DEFAULT NULL,
  `id_proveedor` int(10) unsigned DEFAULT NULL,
  `id_documento` int(10) unsigned DEFAULT NULL,
  `id_categoria` int(10) unsigned DEFAULT NULL,
  `id_fabricante` int(10) unsigned DEFAULT NULL,
  `id_modelo` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_proveedor` (`id_proveedor`),
  KEY `id_documento` (`id_documento`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_fabricante` (`id_fabricante`),
  KEY `id_modelo` (`id_modelo`),
  CONSTRAINT `tbl_licencias_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `tbl_proveedores` (`id`),
  CONSTRAINT `tbl_licencias_ibfk_2` FOREIGN KEY (`id_documento`) REFERENCES `tbl_documentos` (`id`),
  CONSTRAINT `tbl_licencias_ibfk_3` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categorias` (`id`),
  CONSTRAINT `tbl_licencias_ibfk_4` FOREIGN KEY (`id_fabricante`) REFERENCES `tbl_fabricantes` (`id`),
  CONSTRAINT `tbl_licencias_ibfk_5` FOREIGN KEY (`id_modelo`) REFERENCES `tbl_modelos` (`id`)
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
  `id_tipo_mantenimiento` int(10) unsigned NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `observacion` varchar(255) DEFAULT NULL,
  `fecha_inicio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_fin` timestamp NULL DEFAULT NULL,
  `ruta_adjunto` varchar(255) DEFAULT NULL,
  `id_usuario_soporte` int(10) unsigned DEFAULT NULL,
  `id_proveedor` int(10) unsigned DEFAULT NULL,
  `id_estado_inicial` int(10) unsigned DEFAULT NULL,
  `id_estado_final` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario_soporte` (`id_usuario_soporte`),
  KEY `id_desk_lap` (`id_desk_lap`),
  KEY `id_proveedor` (`id_proveedor`),
  KEY `id_estado_inicial` (`id_estado_inicial`),
  KEY `id_estado_final` (`id_estado_final`),
  KEY `id_tipo_mantenimiento` (`id_tipo_mantenimiento`),
  CONSTRAINT `tbl_mantenimientos_ibfk_1` FOREIGN KEY (`id_usuario_soporte`) REFERENCES `tbl_usuarios` (`id`),
  CONSTRAINT `tbl_mantenimientos_ibfk_2` FOREIGN KEY (`id_desk_lap`) REFERENCES `tbl_desk_lap` (`id`),
  CONSTRAINT `tbl_mantenimientos_ibfk_3` FOREIGN KEY (`id_proveedor`) REFERENCES `tbl_proveedores` (`id`),
  CONSTRAINT `tbl_mantenimientos_ibfk_4` FOREIGN KEY (`id_estado_inicial`) REFERENCES `tbl_estados` (`id`),
  CONSTRAINT `tbl_mantenimientos_ibfk_5` FOREIGN KEY (`id_estado_final`) REFERENCES `tbl_estados` (`id`),
  CONSTRAINT `tbl_mantenimientos_ibfk_6` FOREIGN KEY (`id_tipo_mantenimiento`) REFERENCES `tbl_tipos_mantenimiento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_mantenimientos: ~0 rows (aproximadamente)
DELETE FROM `tbl_mantenimientos`;

-- Volcando estructura para tabla sys_inventario_transber.tbl_modelos
CREATE TABLE IF NOT EXISTS `tbl_modelos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modelo` varchar(150) NOT NULL,
  `id_fabricante` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_fabricante` (`id_fabricante`),
  CONSTRAINT `tbl_modelos_ibfk_1` FOREIGN KEY (`id_fabricante`) REFERENCES `tbl_fabricantes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_modelos: ~15 rows (aproximadamente)
DELETE FROM `tbl_modelos`;
INSERT INTO `tbl_modelos` (`id`, `modelo`, `id_fabricante`) VALUES
	(1, 'ThinkPad E14', 1),
	(2, 'IdeaPad 3', 1),
	(3, 'Pavilion 15', 2),
	(4, 'Envy x360', 2),
	(5, 'iPhone 13', 3),
	(6, 'iPhone SE', 3),
	(7, 'Galaxy S23', 4),
	(8, 'Galaxy A54', 4),
	(9, 'PIXMA G3160', 5),
	(10, 'MAXIFY GX6010', 5),
	(11, 'EcoTank L3250', 6),
	(12, 'WorkForce WF-2850', 6),
	(13, 'ThinkCentre M80s', 7),
	(14, 'Blade A54', 9),
	(15, 'WorkCentre 3655i', 11);

-- Volcando estructura para tabla sys_inventario_transber.tbl_perfiles
CREATE TABLE IF NOT EXISTS `tbl_perfiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `perfil` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_perfiles: ~3 rows (aproximadamente)
DELETE FROM `tbl_perfiles`;
INSERT INTO `tbl_perfiles` (`id`, `perfil`) VALUES
	(1, 'Administrador'),
	(2, 'Supervisor'),
	(3, 'Soporte Técnico');

-- Volcando estructura para tabla sys_inventario_transber.tbl_productos
CREATE TABLE IF NOT EXISTS `tbl_productos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `producto` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_productos: ~2 rows (aproximadamente)
DELETE FROM `tbl_productos`;
INSERT INTO `tbl_productos` (`id`, `producto`) VALUES
	(1, 'Bien'),
	(2, 'Servicio'),
	(3, 'Propio');

-- Volcando estructura para tabla sys_inventario_transber.tbl_proveedores
CREATE TABLE IF NOT EXISTS `tbl_proveedores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `proveedor` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `contacto` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telefono` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_proveedores: ~0 rows (aproximadamente)
DELETE FROM `tbl_proveedores`;
INSERT INTO `tbl_proveedores` (`id`, `proveedor`, `direccion`, `contacto`, `email`, `telefono`) VALUES
	(1, 'Transber S.A.C', 'Calle Cadmio 129 Urb. Ind. Grimanesa', 'Transber', 'soporteti@transberperu.com', '988600940');

-- Volcando estructura para tabla sys_inventario_transber.tbl_sedes
CREATE TABLE IF NOT EXISTS `tbl_sedes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sede` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_sedes: ~12 rows (aproximadamente)
DELETE FROM `tbl_sedes`;
INSERT INTO `tbl_sedes` (`id`, `sede`) VALUES
	(1, 'Grimanesa'),
	(2, 'Independencia'),
	(3, 'San Isidro'),
	(4, 'Cuzco'),
	(5, 'Iquitos - Aerepuerto'),
	(6, 'Iquitos - Morona'),
	(7, 'Tarapoto'),
	(8, 'Arequipa'),
	(9, 'Monte Azul'),
	(10, 'Piura'),
	(11, 'Pucallpa'),
	(12, 'Petrotal');

-- Volcando estructura para tabla sys_inventario_transber.tbl_tipos_mantenimiento
CREATE TABLE IF NOT EXISTS `tbl_tipos_mantenimiento` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_tipos_mantenimiento: ~4 rows (aproximadamente)
DELETE FROM `tbl_tipos_mantenimiento`;
INSERT INTO `tbl_tipos_mantenimiento` (`id`, `tipo`, `descripcion`) VALUES
	(1, 'Preventivo', 'Mantenimiento rutinario para evitar fallas'),
	(2, 'Correctivo', 'Reparación después de una falla'),
	(3, 'Predictivo', 'Basado en monitoreo para anticipar fallas'),
	(4, 'Garantía', 'Mantenimiento cubierto por garantía del fabricante');

-- Volcando estructura para tabla sys_inventario_transber.tbl_tipo_adjuntos
CREATE TABLE IF NOT EXISTS `tbl_tipo_adjuntos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adjunto` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_tipo_adjuntos: ~4 rows (aproximadamente)
DELETE FROM `tbl_tipo_adjuntos`;
INSERT INTO `tbl_tipo_adjuntos` (`id`, `adjunto`) VALUES
	(1, 'Orden de Compra'),
	(2, 'Factura'),
	(3, 'Guía de Remisión'),
	(4, 'Contrato');

-- Volcando estructura para tabla sys_inventario_transber.tbl_usuarios
CREATE TABLE IF NOT EXISTS `tbl_usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `usuario_red` varchar(255) NOT NULL,
  `contrasena` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `id_sede` int(10) unsigned NOT NULL,
  `id_perfil` int(10) unsigned NOT NULL,
  `id_area` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sede` (`id_sede`),
  KEY `id_perfil` (`id_perfil`),
  KEY `id_area` (`id_area`),
  CONSTRAINT `tbl_usuarios_ibfk_1` FOREIGN KEY (`id_sede`) REFERENCES `tbl_sedes` (`id`),
  CONSTRAINT `tbl_usuarios_ibfk_2` FOREIGN KEY (`id_perfil`) REFERENCES `tbl_perfiles` (`id`),
  CONSTRAINT `tbl_usuarios_ibfk_3` FOREIGN KEY (`id_area`) REFERENCES `tbl_areas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sys_inventario_transber.tbl_usuarios: ~1 rows (aproximadamente)
DELETE FROM `tbl_usuarios`;
INSERT INTO `tbl_usuarios` (`id`, `nombre`, `usuario_red`, `contrasena`, `email`, `id_sede`, `id_perfil`, `id_area`) VALUES
	(1, 'Kevin Torres', 'ktorres', '1234', 'ktorres@transberperu.com', 1, 1, 10),
	(2, 'Sergio Ventura', 'sventura', '1234', 'sventura@transberperu.com', 1, 1, 10);

-- Volcando estructura para disparador sys_inventario_transber.trg_asignaciones_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER trg_asignaciones_update
AFTER UPDATE ON tbl_asignaciones
FOR EACH ROW
BEGIN
    -- Cambio de usuario
    IF OLD.id_usuario <> NEW.id_usuario THEN
        INSERT INTO tbl_historial_activos (
            id_asignacion,
            tipo_activo,
            id_activo,
            id_usuario_anterior,
            id_usuario_nuevo,
            id_entrega,
            fecha_movimiento,
            observacion
        ) VALUES (
            NEW.id,
            'Usuario',
            NULL,
            OLD.id_usuario,
            NEW.id_usuario,
            NEW.id_entrega,
            NEW.fecha_movimiento,
            'Cambio de usuario'
        );
    END IF;

    -- Cambio de Desk/Lap
    IF OLD.id_desk_lap <> NEW.id_desk_lap THEN
        INSERT INTO tbl_historial_activos (
            id_asignacion,
            tipo_activo,
            id_activo,
            id_usuario_anterior,
            id_usuario_nuevo,
            id_entrega,
            fecha_movimiento,
            observacion
        ) VALUES (
            NEW.id,
            'DeskLap',
            NEW.id_desk_lap,
            NEW.id_usuario,
            NEW.id_usuario,
            NEW.id_entrega,
            NEW.fecha_movimiento,
            'Cambio de equipo Desk/Lap'
        );
    END IF;

    -- Cambio de Celular
    IF OLD.id_celular <> NEW.id_celular THEN
        INSERT INTO tbl_historial_activos (
            id_asignacion,
            tipo_activo,
            id_activo,
            id_usuario_anterior,
            id_usuario_nuevo,
            id_entrega,
            fecha_movimiento,
            observacion
        ) VALUES (
            NEW.id,
            'Celular',
            NEW.id_celular,
            NEW.id_usuario,
            NEW.id_usuario,
            NEW.id_entrega,
            NEW.fecha_movimiento,
            'Cambio de celular'
        );
    END IF;

END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador sys_inventario_transber.trg_asignacion_accesorio_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER trg_asignacion_accesorio_delete
AFTER DELETE ON tbl_asignacion_accesorios
FOR EACH ROW
BEGIN
    DECLARE usuario_asignado INT;

    -- Usuario que tenía el accesorio
    SELECT id_usuario INTO usuario_asignado
    FROM tbl_asignaciones
    WHERE id = OLD.id_asignacion;

    -- Insertar en historial
    INSERT INTO tbl_historial_activos (
        id_asignacion,
        tipo_activo,
        id_activo,
        id_usuario_anterior,
        id_usuario_nuevo,
        id_entrega,
        fecha_movimiento,
        observacion
    ) VALUES (
        OLD.id_asignacion,
        'Accesorio',
        OLD.id_accesorio,
        usuario_asignado,
        NULL,  -- Queda sin usuario
        (SELECT id_entrega FROM tbl_asignaciones WHERE id = OLD.id_asignacion),
        NOW(),
        'Retiro de accesorio'
    );
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador sys_inventario_transber.trg_asignacion_accesorio_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER trg_asignacion_accesorio_insert
AFTER INSERT ON tbl_asignacion_accesorios
FOR EACH ROW
BEGIN
    DECLARE usuario_asignado INT;

    -- Obtener el usuario al que se le asignó el accesorio
    SELECT id_usuario INTO usuario_asignado
    FROM tbl_asignaciones
    WHERE id = NEW.id_asignacion;

    -- Insertar en historial
    INSERT INTO tbl_historial_activos (
        id_asignacion,
        tipo_activo,
        id_activo,
        id_usuario_anterior,
        id_usuario_nuevo,
        id_entrega,
        fecha_movimiento,
        observacion
    ) VALUES (
        NEW.id_asignacion,
        'Accesorio',
        NEW.id_accesorio,
        NULL,  -- No había usuario antes (es nuevo)
        usuario_asignado,
        (SELECT id_entrega FROM tbl_asignaciones WHERE id = NEW.id_asignacion),
        NOW(),
        'Asignación de accesorio'
    );
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador sys_inventario_transber.trg_asignacion_accesorio_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER trg_asignacion_accesorio_update
AFTER UPDATE ON tbl_asignacion_accesorios
FOR EACH ROW
BEGIN
    DECLARE usuario_anterior INT;
    DECLARE usuario_nuevo INT;

    -- Usuario de la asignación anterior
    SELECT id_usuario INTO usuario_anterior
    FROM tbl_asignaciones
    WHERE id = OLD.id_asignacion;

    -- Usuario de la asignación nueva
    SELECT id_usuario INTO usuario_nuevo
    FROM tbl_asignaciones
    WHERE id = NEW.id_asignacion;

    -- Insertar en historial
    INSERT INTO tbl_historial_activos (
        id_asignacion,
        tipo_activo,
        id_activo,
        id_usuario_anterior,
        id_usuario_nuevo,
        id_entrega,
        fecha_movimiento,
        observacion
    ) VALUES (
        NEW.id_asignacion,
        'Accesorio',
        NEW.id_accesorio,
        usuario_anterior,
        usuario_nuevo,
        (SELECT id_entrega FROM tbl_asignaciones WHERE id = NEW.id_asignacion),
        NOW(),
        'Cambio de asignación de accesorio'
    );
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
