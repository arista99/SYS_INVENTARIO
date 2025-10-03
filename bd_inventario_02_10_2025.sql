
CREATE DATABASE IF NOT EXISTS sys_inventario_transber;
USE sys_inventario_transber;

-- ==========================================
-- 1. TABLAS BASE (Catálogos y configuración)
-- ==========================================

-- Tipos de entrega de activos (Asignación inicial, Reemplazo por falla, Préstamo temporal, Renovación de equipo,Devolución de equipo)
-- trazabilidad del motivo de asignación
CREATE TABLE tbl_entregas (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    entrega VARCHAR(150) NOT NULL
);

-- Archivos adjuntos (facturas, contratos, guías, etc
CREATE TABLE tbl_tipo_adjuntos (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    adjunto VARCHAR(255) NOT NULL
);

-- Productos de proveedores (Bien o Servicio)
CREATE TABLE tbl_productos (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    producto VARCHAR(150) NOT NULL
);

-- Sedes físicas
CREATE TABLE tbl_sedes (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    sede VARCHAR(150) NOT NULL
);

-- Centros de costo
CREATE TABLE tbl_centro_costo (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    centro_costo VARCHAR(150) NOT NULL
);

-- Áreas funcionales
CREATE TABLE tbl_areas (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `area` VARCHAR(150) NOT NULL
);

-- Perfiles de usuarios
CREATE TABLE tbl_perfiles (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    perfil VARCHAR(150) NOT NULL
);

-- Condiciones de activos (Nuevo, Usado, En reparación , Defectuoso.)
CREATE TABLE tbl_condiciones (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    condicion VARCHAR(150) NOT NULL
);

-- Estados de activos (Asignado, Disponible, En mantenimiento, Dado de baja.)
CREATE TABLE tbl_estados (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    estado VARCHAR(150) NOT NULL
);

-- Fabricantes
CREATE TABLE tbl_fabricantes (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fabricante VARCHAR(150) NOT NULL
);

-- Modelos
CREATE TABLE tbl_modelos (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    modelo VARCHAR(150) NOT NULL,
    id_categoria INT UNSIGNED NOT NULL,
    id_fabricante INT UNSIGNED NOT NULL,
    FOREIGN KEY (id_categoria) REFERENCES tbl_categorias(id) ON DELETE CASCADE,
    FOREIGN KEY (id_fabricante) REFERENCES tbl_fabricantes(id) ON DELETE CASCADE
);
tbl_modelos
-- Categorías de activos (Laptop, Celular, etc.)
CREATE TABLE tbl_categorias (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    categoria VARCHAR(150) NOT NULL
);

-- Tabla catálogo de tipos de mantenimiento
-- 'Preventivo', 'Mantenimiento rutinario para evitar fallas'
-- 'Correctivo', 'Reparación después de una falla'),
-- 'Predictivo', 'Basado en monitoreo para anticipar fallas'
-- 'Garantía', 'Mantenimiento cubierto por garantía del fabricante'
CREATE TABLE tbl_tipos_mantenimiento (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255) NULL
);

-- ==========================================
-- 2. DOCUMENTOS Y PROVEEDORES
-- ==========================================

-- Documentos (relacionados con adjuntos)
CREATE TABLE tbl_documentos (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    id_tipo_adjunto INT UNSIGNED NULL,
    ruta_adjunto VARCHAR(255) NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_inicio TIMESTAMP NULL,
    fecha_termino TIMESTAMP NULL,
    FOREIGN KEY (id_tipo_adjunto) REFERENCES tbl_tipo_adjuntos(id)
);

-- Proveedores
CREATE TABLE tbl_proveedores (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    proveedor VARCHAR(255) NOT NULL,
    direccion VARCHAR(255) NULL,
    contacto VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    telefono VARCHAR(150) NOT NULL,
    id_producto INT UNSIGNED NULL,
    id_documento INT UNSIGNED NULL,
    FOREIGN KEY (id_producto) REFERENCES tbl_productos(id),
    FOREIGN KEY (id_documento) REFERENCES tbl_documentos(id)
);

-- ==========================================
-- 3. USUARIOS
-- ==========================================

-- Usuarios
CREATE TABLE tbl_usuarios (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    usuario_red VARCHAR(255) NOT NULL,
    contrasena VARCHAR(150) NULL,
    email VARCHAR(150) NULL,
    id_sede INT UNSIGNED NOT NULL,
    id_perfil INT UNSIGNED NOT NULL,
    id_area INT UNSIGNED NOT NULL,
    FOREIGN KEY (id_sede) REFERENCES tbl_sedes(id),
    FOREIGN KEY (id_perfil) REFERENCES tbl_perfiles(id),
    FOREIGN KEY (id_area) REFERENCES tbl_areas(id)
);

-- ==========================================
-- 4. TABLAS DE ACTIVOS
-- ==========================================

-- Equipos Desktop/Laptop
CREATE TABLE tbl_desk_lap (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nom_equipo VARCHAR(150) NULL, -
    ns VARCHAR(150) NULL,-
    procesador VARCHAR(255) NULL,-
    id_proveedor INT UNSIGNED NULL,
    disco VARCHAR(255) NULL,
    memoria VARCHAR(255) NULL,
    ip VARCHAR(50) NULL,
    numero_part VARCHAR(255) NULL,
    fecha_compra TIMESTAMP NULL,
  	 fecha_inicio_garantia TIMESTAMP NULL,
    fecha_fin_garantia TIMESTAMP NULL,
    fecha_baja TIMESTAMP NULL,
    id_centro_costo INT UNSIGNED NULL,
    id_condicion INT UNSIGNED NULL,
    id_estado INT UNSIGNED NULL,
    id_categoria INT UNSIGNED NULL,
    id_fabricante INT UNSIGNED NULL,
    id_modelo INT UNSIGNED NULL,
    id_documento INT UNSIGNED NULL,
    FOREIGN KEY (id_centro_costo) REFERENCES tbl_centro_costo(id),
    FOREIGN KEY (id_condicion) REFERENCES tbl_condiciones(id),
    FOREIGN KEY (id_estado) REFERENCES tbl_estados(id),
    FOREIGN KEY (id_categoria) REFERENCES tbl_categorias(id),
    FOREIGN KEY (id_fabricante) REFERENCES tbl_fabricantes(id),
    FOREIGN KEY (id_modelo) REFERENCES tbl_modelos(id),
    FOREIGN KEY (id_documento) REFERENCES tbl_documentos(id)
);

-- Licencias
CREATE TABLE tbl_licencias (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    software VARCHAR(255) NOT NULL,
    nro_version VARCHAR(255) NULL,
    cantidad INT NOT NULL,
    tipo VARCHAR(150) NOT NULL,
    id_proveedor INT UNSIGNED NULL,
    id_documento INT UNSIGNED NULL,
    id_categoria INT UNSIGNED NULL,
    id_fabricante INT UNSIGNED NULL,
    id_modelo INT UNSIGNED NULL,
    fecha_inicio_licencia TIMESTAMP NULL,
    fecha_fin_licencia TIMESTAMP NULL,
    FOREIGN KEY (id_proveedor) REFERENCES tbl_proveedores(id),
    FOREIGN KEY (id_documento) REFERENCES tbl_documentos(id),
    FOREIGN KEY (id_categoria) REFERENCES tbl_categorias(id),
    FOREIGN KEY (id_fabricante) REFERENCES tbl_fabricantes(id),
    FOREIGN KEY (id_modelo) REFERENCES tbl_modelos(id)
);

-- Licencias asignadas a equipos
CREATE TABLE tbl_licencias_asignada (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_desk_lap INT UNSIGNED NOT NULL,
    id_licencia INT UNSIGNED NOT NULL,
    fecha_asignacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_desk_lap) REFERENCES tbl_desk_lap(id),
    FOREIGN KEY (id_licencia) REFERENCES tbl_licencias(id)
);

-- Celulares
CREATE TABLE tbl_celulares (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    imei VARCHAR(255) NOT NULL,
    numero VARCHAR(150) NULL,
    ns VARCHAR(150) NULL,
    id_categoria INT UNSIGNED NOT NULL,
    id_fabricante INT UNSIGNED NULL,
    id_modelo INT UNSIGNED NULL,
    id_condicion INT UNSIGNED NOT NULL,
    id_estado INT UNSIGNED NOT NULL,
    id_proveedor INT UNSIGNED NOT NULL,
    id_documento INT UNSIGNED NULL,
    FOREIGN KEY (id_categoria) REFERENCES tbl_categorias(id),
    FOREIGN KEY (id_fabricante) REFERENCES tbl_fabricantes(id),
    FOREIGN KEY (id_modelo) REFERENCES tbl_modelos(id),
    FOREIGN KEY (id_condicion) REFERENCES tbl_condiciones(id),
    FOREIGN KEY (id_estado) REFERENCES tbl_estados(id),
    FOREIGN KEY (id_proveedor) REFERENCES tbl_proveedores(id),
    FOREIGN KEY (id_documento) REFERENCES tbl_documentos(id)
);

-- Impresoras
CREATE TABLE tbl_impresoras (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_area INT UNSIGNED NULL,
    id_categoria INT UNSIGNED NULL,
    id_sede INT UNSIGNED NULL,
    id_proveedor INT UNSIGNED NOT NULL,
    id_fabricante INT UNSIGNED NOT NULL,
    id_modelo INT UNSIGNED NOT NULL,
    ip VARCHAR(150) NULL,
    ns VARCHAR(255) NULL,
    id_estado INT UNSIGNED NOT NULL,
    id_condicion INT UNSIGNED NULL,
    id_documento INT UNSIGNED NULL,
    fecha_compra TIMESTAMP NULL,
    fecha_instalacion TIMESTAMP NULL,
    fecha_retiro TIMESTAMP NULL,
    FOREIGN KEY (id_area) REFERENCES tbl_areas(id),
    FOREIGN KEY (id_categoria) REFERENCES tbl_categorias(id),
    FOREIGN KEY (id_fabricante) REFERENCES tbl_fabricantes(id),
    FOREIGN KEY (id_modelo) REFERENCES tbl_modelos(id),
    FOREIGN KEY (id_estado) REFERENCES tbl_estados(id),
    FOREIGN KEY (id_condicion) REFERENCES tbl_condiciones(id),
    FOREIGN KEY (id_proveedor) REFERENCES tbl_proveedores(id),
    FOREIGN KEY (id_documento) REFERENCES tbl_documentos(id),
    FOREIGN KEY (id_sede) REFERENCES tbl_sedes(id)
);

-- Accesorios
CREATE TABLE tbl_accesorios (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ns VARCHAR(255) NOT NULL,
    id_categoria INT UNSIGNED NOT NULL,
    id_fabricante INT UNSIGNED NOT NULL,
    id_condicion INT UNSIGNED NOT NULL,
    id_estado INT UNSIGNED NOT NULL,
    id_proveedor INT UNSIGNED NOT NULL,
    id_documento INT UNSIGNED NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_categoria) REFERENCES tbl_categorias(id),
    FOREIGN KEY (id_fabricante) REFERENCES tbl_fabricantes(id),
    FOREIGN KEY (id_condicion) REFERENCES tbl_condiciones(id),
    FOREIGN KEY (id_estado) REFERENCES tbl_estados(id),
    FOREIGN KEY (id_proveedor) REFERENCES tbl_proveedores(id),
    FOREIGN KEY (id_documento) REFERENCES tbl_documentos(id)
);

-- Infraestructura (Routers, switches, etc.)
CREATE TABLE tbl_infraestructura (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ip VARCHAR(150) NULL,
    ns VARCHAR(255) NOT NULL,
    dns VARCHAR(150) NULL,
    enlace VARCHAR(150) NULL,
    mac VARCHAR(150) NULL,
    id_area INT UNSIGNED NOT NULL,
    id_sede INT UNSIGNED NOT NULL,
    id_proveedor INT UNSIGNED NOT NULL,
    id_modelo INT UNSIGNED NOT NULL,
    id_categoria INT UNSIGNED NOT NULL,
    id_fabricante INT UNSIGNED NOT NULL,
    id_condicion INT UNSIGNED NOT NULL,
    id_estado INT UNSIGNED NOT NULL,
    id_documento INT UNSIGNED NULL,
    fecha_compra TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_area) REFERENCES tbl_areas(id),
    FOREIGN KEY (id_categoria) REFERENCES tbl_categorias(id),
    FOREIGN KEY (id_fabricante) REFERENCES tbl_fabricantes(id),
    FOREIGN KEY (id_condicion) REFERENCES tbl_condiciones(id),
    FOREIGN KEY (id_estado) REFERENCES tbl_estados(id),
    FOREIGN KEY (id_modelo) REFERENCES tbl_modelos(id),
    FOREIGN KEY (id_proveedor) REFERENCES tbl_proveedores(id),
    FOREIGN KEY (id_documento) REFERENCES tbl_documentos(id),
    FOREIGN KEY (id_sede) REFERENCES tbl_sedes(id)
);

-- ==========================================
-- 5. TABLAS DE MOVIMIENTOS
-- ==========================================

-- Asignaciones de activos a usuarios
CREATE TABLE tbl_asignaciones (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT UNSIGNED NOT NULL,
    id_celular INT UNSIGNED NULL,
    id_desk_lap INT UNSIGNED NULL,
    observacion VARCHAR(255) NULL,
    ruta_adjunto VARCHAR(255) NULL,
    fecha_movimiento TIMESTAMP NOT NULL, -- fecha moviento controla cuando en id de entregas ralice este tipo de movimientos(Asignación inicial, Reemplazo por falla, Préstamo temporal, Renovación de equipo,Devolución de equipo)
    id_entrega INT UNSIGNED NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES tbl_usuarios(id),
    FOREIGN KEY (id_celular) REFERENCES tbl_celulares(id),
    FOREIGN KEY (id_desk_lap) REFERENCES tbl_desk_lap(id),
    FOREIGN KEY (id_entrega) REFERENCES tbl_entregas(id)
);

CREATE TABLE tbl_asignacion_accesorios (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_asignacion INT UNSIGNED NOT NULL,
    id_accesorio INT UNSIGNED NOT NULL,
    fecha_asignacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_devolucion TIMESTAMP NULL,
    FOREIGN KEY (id_asignacion) REFERENCES tbl_asignaciones(id),
    FOREIGN KEY (id_accesorio) REFERENCES tbl_accesorios(id)
);

-- Historial de activos (cambios de usuario o centro de costo)
CREATE TABLE tbl_historial_activos (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_asignacion INT UNSIGNED NOT NULL,
    id_usuario_anterior INT UNSIGNED NULL,
    id_usuario_nuevo INT UNSIGNED NULL,
    tipo_activo ENUM('DeskLap','Celular','Accesorio') NOT NULL,
    id_entrega INT UNSIGNED NULL,
    fecha_movimiento TIMESTAMP NULL,
    FOREIGN KEY (id_asignacion) REFERENCES tbl_asignaciones(id),
    FOREIGN KEY (id_usuario_anterior) REFERENCES tbl_usuarios(id) ON DELETE RESTRICT,
    FOREIGN KEY (id_usuario_nuevo) REFERENCES tbl_usuarios(id) ON DELETE RESTRICT,
    FOREIGN KEY (id_entrega) REFERENCES tbl_entregas(id) ON DELETE RESTRICT
);

-- Mantenimientos
CREATE TABLE tbl_mantenimientos (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_desk_lap INT UNSIGNED NOT NULL,
    id_tipo_mantenimiento INT UNSIGNED NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    observacion VARCHAR(255) NULL,
    fecha_inicio TIMESTAMP NOT NULL,
    fecha_fin TIMESTAMP NULL,
    ruta_adjunto VARCHAR(255) NULL,
    id_usuario_soporte INT UNSIGNED NULL,
    id_proveedor INT UNSIGNED NULL,
    id_estado_inicial INT UNSIGNED NULL,
    id_estado_final INT UNSIGNED NULL,
    FOREIGN KEY (id_usuario_soporte) REFERENCES tbl_usuarios(id),
    FOREIGN KEY (id_desk_lap) REFERENCES tbl_desk_lap(id),
    FOREIGN KEY (id_proveedor) REFERENCES tbl_proveedores(id),
    FOREIGN KEY (id_estado_inicial) REFERENCES tbl_estados(id),
    FOREIGN KEY (id_estado_final) REFERENCES tbl_estados(id),
    FOREIGN KEY (id_tipo_mantenimiento) REFERENCES tbl_tipos_mantenimiento(id)
);
====================================================================================

USE sys_inventario_transber;

-- ==========================
-- Inserts: tbl_tipos_mantenimiento
-- ==========================
INSERT INTO tbl_tipos_mantenimiento (tipo, descripcion) VALUES
('Preventivo', 'Mantenimiento rutinario para evitar fallas'),
('Correctivo', 'Reparación después de una falla'),
('Predictivo', 'Basado en monitoreo para anticipar fallas'),
('Garantía', 'Mantenimiento cubierto por garantía del fabricante');

-- ==========================
-- Inserts: tbl_entregas
-- ==========================
INSERT INTO tbl_entregas (entrega) VALUES
('Asignación'),
('Préstamo'),
('Devolución'),
('Reasignación');

-- ==========================
-- Inserts: tbl_tipo_adjuntos
-- ==========================
INSERT INTO tbl_tipo_adjuntos (adjunto) VALUES
('Orden de Compra'),
('Factura'),
('Guía de Remisión'),
('Contrato');

-- ==========================
-- Inserts: tbl_productos
-- ==========================
INSERT INTO tbl_productos (producto) VALUES
('Bien'),
('Servicio'),
('Propio');

-- ==========================
-- Inserts: tbl_sedes
-- ==========================
INSERT INTO tbl_sedes (sede) VALUES
('Grimanesa'),
('Independencia'),
('San Isidro'),
('Cuzco'),
('Iquitos - Aerepuerto'),
('Iquitos - Morona'),
('Tarapoto'),
('Arequipa'),
('Monte Azul'),
('Piura'),
('Pucallpa'),
('Petrotal');

-- ==========================
-- Inserts: tbl_areas
-- ==========================
INSERT INTO tbl_areas (area) VALUES
('Almacen'),
('Recursos Humanos'),
('Cna'),
('Cobranzas'),
('Contabilidad'),
('Exportaciones'),
('Facturacion'),
('Importaciones'),
('Proyectos'),
('Sistemas')
;

-- ==========================
-- Inserts: tbl_centro_costo
-- ==========================
INSERT INTO tbl_centro_costo (centro_costo) VALUES
('Administración'),
('Almacenes'),
('CNA'),
('Cobranzas'),
('Comercial'),
('Compras'),
('Contabilidad'),
('Exportaciones'),
('Facturacion'),
('Finanzas'),
('GAF'),
('Gerencia'),
('HSE')
;

-- ==========================
-- Inserts: tbl_categorias
-- ==========================
INSERT INTO tbl_categorias (categoria) VALUES
('Laptop'),
('Desktop'),
('Celular'),
('Impresora'),
('Accesorio'),
('Infraestructura');

-- ==========================
-- Inserts: tbl_fabricantes
-- ==========================
INSERT INTO tbl_fabricantes (fabricante) VALUES
('HP'),
('Dell'),
('Lenovo'),
('Apple'),
('Samsung'),
('Huawei');

-- ==========================
-- Inserts: tbl_perfiles
-- ==========================
INSERT INTO tbl_perfiles (perfil) VALUES
('Administrador'),
('Supervisor'),
('Soporte Técnico');

-- ==========================
-- Inserts: tbl_condiciones
-- ==========================
INSERT INTO tbl_condiciones (condicion) VALUES
('Nuevo'),
('Usado'),
('En reparación'),
('Defectuoso');

-- ==========================
-- Inserts: tbl_estados
-- ==========================
INSERT INTO tbl_estados (estado) VALUES
('Disponible'),
('Asignado'),
('En mantenimiento'),
('Dado de baja');

-- ==========================
-- Inserts: tbl_proveedores
-- (requiere documentos/productos)
-- ==========================
INSERT INTO tbl_proveedores (proveedor, direccion, contacto, email, telefono, id_producto) VALUES
('Transber S.A.C', 'Calle Cadmio 129 Urb. Ind. Grimanesa', 'Transber', 'soporteti@transberperu.com', '988600940', 3);

-- ========================================
-- Modelos (ejemplos)
-- ========================================

-- Laptops
INSERT INTO tbl_modelos (modelo, id_categoria, id_fabricante) VALUES
('Pavilion', 1, 1),   -- HP
('EliteBook', 1, 1),
('Inspiron', 1, 2),   -- Dell
('XPS 13', 1, 2),
('ThinkPad T14', 1, 3), -- Lenovo
('IdeaPad 3', 1, 3),
('MacBook Air', 1, 4), -- Apple
('MacBook Pro', 1, 4),
('Galaxy Book Pro', 1, 5), -- Samsung
('Galaxy Book Flex', 1, 5),
('MateBook D15', 1, 6), -- Huawei
('MateBook X Pro', 1, 6);

-- Desktops
INSERT INTO tbl_modelos (modelo, id_categoria, id_fabricante) VALUES
('HP ProDesk 400', 2, 1),
('HP EliteDesk 800', 2, 1),
('Dell OptiPlex 7090', 2, 2),
('Dell Vostro 3681', 2, 2),
('Lenovo ThinkCentre M70', 2, 3),
('Lenovo Legion Tower', 2, 3),
('Mac Mini', 2, 4),
('iMac 24', 2, 4);

-- Celulares
INSERT INTO tbl_modelos (modelo, id_categoria, id_fabricante) VALUES
('iPhone 14', 3, 4),   -- Apple
('iPhone SE', 3, 4),
('Galaxy S23', 3, 5),  -- Samsung
('Galaxy A54', 3, 5),
('P50 Pro', 3, 6),     -- Huawei
('Mate 50', 3, 6);

-- Impresoras
INSERT INTO tbl_modelos (modelo, id_categoria, id_fabricante) VALUES
('HP LaserJet Pro M404', 4, 1),
('HP DeskJet 2720', 4, 1),
('Samsung Xpress M2020', 4, 5),
('Samsung CLP-680', 4, 5);

-- Accesorios
INSERT INTO tbl_modelos (modelo, id_categoria, id_fabricante) VALUES
('HP Mouse X3000', 5, 1),
('Dell Keyboard KB216', 5, 2),
('Lenovo ThinkVision Monitor', 5, 3),
('Apple Magic Mouse', 5, 4),
('Samsung Monitor 27"', 5, 5),
('Huawei FreeBuds 5i', 5, 6);

-- Infraestructura (Switches, servidores, etc.)
INSERT INTO tbl_modelos (modelo, id_categoria, id_fabricante) VALUES
('HP ProLiant DL380', 6, 1),
('Dell PowerEdge R740', 6, 2),
('Lenovo ThinkSystem SR650', 6, 3),
('Apple Xserve (Legacy)', 6, 4),
('Samsung Network Switch NX500', 6, 5),
('Huawei CloudEngine S5735', 6, 6);