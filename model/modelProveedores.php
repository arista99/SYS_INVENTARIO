SELECT tpro.id,tpro.proveedor,tpro.direccion,tpro.contacto,tpro.email,tpro.telefono,tpru.producto,td.documento
FROM tbl_proveedores AS tpro
INNER JOIN tbl_productos AS tpru ON tpru.id=tpro.id_producto
LEFT JOIN tbl_documentos AS td ON td.id=tpro.id_documento