
--DB de sistema de facturacion web version 1.0 beta
--developed by dgutierrez

CREATE TABLE categoria(
	IDCategoria int(11) NOT NULL,
	Nombre varchar(50) NOT NULL,
	Estado boolean NOT NULL DEFAULT 1,
	created_by int(11) NOT NULL,
	updated_by int(11) NOT NULL,
	created_at timestamp NOT NULL DEFAULT NOW(),
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE articulo(
	IDArticulo int(11) NOT NULL,
	IDCategoria int(11) NOT NULL,
	Codigo varchar(40) NOT NULL,
	Nombre varchar(50) NOT NULL,
	Stock int(11) NOT NULL,
	Detalle varchar(100) DEFAULT NULL,
	Imagen varchar(200) DEFAULT NULL,
	Estado boolean NOT NULL DEFAULT 1,
	created_by int(11) NOT NULL,
	updated_by int(11) NOT NULL,
	created_at timestamp NOT NULL DEFAULT NOW(),
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE cliente(
	IDCliente int(11) NOT NULL,
	TipoPersona varchar(20) NOT NULL,
	Nombre varchar(70) NOT NULL,
	TipoDocumento varchar(20) NOT NULL,
	NumeroDocumento varchar(30) NOT NULL,
	Direccion varchar(100) DEFAULT NULL,
	Telefono varchar(20) DEFAULT NULL,
	Correo varchar(20) DEFAULT NULL,
	Estado boolean NOT NULL DEFAULT 1,
	created_by int(11) NOT NULL,
	updated_by int(11) NOT NULL,
	created_at timestamp NOT NULL DEFAULT NOW(),
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE usuario(
	IDUsuario int(11) NOT NULL,
	Nombre varchar(70) NOT NULL,
	TipoDocumento varchar(20) NOT NULL,
	NumeroDocumento varchar(30) NOT NULL,
	Direccion varchar(100) DEFAULT NULL,
	Telefono varchar(20) DEFAULT NULL,
	Correo varchar(20) DEFAULT NULL,
	IDPuesto int(11) NOT NULL,
	IDRole int(11) NOT NULL,
	NombreUsuario varchar(20) NOT NULL,
	Contrasenia varchar(64) NOT NULL,
	Estado boolean NOT NULL DEFAULT 1,
	created_by int(11) NOT NULL,
	updated_by int(11) NOT NULL,
	created_at timestamp NOT NULL DEFAULT NOW(),
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE puesto(
	IDPuesto int(11) NOT NULL,
	Nombre varchar(70) NOT NULL,
	IDDepartamento int(11) NOT NULL,
	Estado boolean NOT NULL DEFAULT 1,
	created_by int(11) NOT NULL,
	updated_by int(11) NOT NULL,
	created_at timestamp NOT NULL DEFAULT NOW(),
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE departamento(
	IDDepartamento int(11) NOT NULL,
	Nombre varchar(70) NOT NULL,
	Estado boolean NOT NULL DEFAULT 1,
	created_by int(11) NOT NULL,
	updated_by int(11) NOT NULL,
	created_at timestamp NOT NULL DEFAULT NOW(),
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE role(
	IDRole int(11) NOT NULL,
	Nombre varchar(70) NOT NULL,
	Estado boolean NOT NULL DEFAULT 1,
	created_by int(11) NOT NULL,
	updated_by int(11) NOT NULL,
	created_at timestamp NOT NULL DEFAULT NOW(),
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE role_permiso(
	IDRolePermiso int(11) NOT NULL,
	IDRole int(11) NOT NULL,
	IDPermiso int(11) NOT NULL,
	Estado boolean NOT NULL DEFAULT 1,
	created_by int(11) NOT NULL,
	updated_by int(11) NOT NULL,
	created_at timestamp NOT NULL DEFAULT NOW(),
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE permiso(
	IDPermiso int(11) NOT NULL,
	Nombre int(11) NOT NULL,
	created_by int(11) NOT NULL,
	updated_by int(11) NOT NULL,
	created_at timestamp NOT NULL DEFAULT NOW(),
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE ingreso(
	IDIngreso int(11) NOT NULL,
	IDProveedor int(11) NOT NULL,
	TipoComprobante varchar(20) NOT NULL,
	SerieComprobante varchar(20) DEFAULT NULL,
	NumeroComprobante varchar(20) NOT NULL,
	FechaComprobante datetime NOT NULL,
	Inpuesto decimal(4,2) NOT NULL,
	TotalCompra decimal(11,2) NOT NULL,
	Estado boolean NOT NULL DEFAULT 1,
	created_by int(11) NOT NULL,
	updated_by int(11) NOT NULL,
	created_at timestamp NOT NULL DEFAULT NOW(),
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE detalle_ingreso(
	IDDetalleIngreso int(11) NOT NULL,
	IDIngreso int(11) NOT NULL,
	IDArticulo int(11) NOT NULL,
	Cantidad int(4) NOT NULL,
	PrecioCompra decimal(11,2) NOT NULL,
	PrecioVenta decimal(11,2) NOT NULL,
	Estado boolean NOT NULL DEFAULT 1,
	created_by int(11) NOT NULL,
	updated_by int(11) NOT NULL,
	created_at timestamp NOT NULL DEFAULT NOW(),
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE proveedor(
	IDProveedor int(11) NOT NULL,
	Nombre varchar(70) NOT NULL,
	TipoDocumento varchar(20) NOT NULL,
	NumeroDocumento varchar(30) NOT NULL,
	Direccion varchar(100) DEFAULT NULL,
	Telefono varchar(20) DEFAULT NULL,
	Correo varchar(20) DEFAULT NULL,
	Estado boolean NOT NULL DEFAULT 1,
	created_by int(11) NOT NULL,
	updated_by int(11) NOT NULL,
	created_at timestamp NOT NULL DEFAULT NOW(),
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


--Falta editar estas dos tablas de ventas y sus detalles porque esan incompletas
CREATE TABLE venta(
	IDVenta int(11) NOT NULL,
	IDProveedor int(11) NOT NULL,
	TipoComprobante varchar(20) NOT NULL,
	SerieComprobante varchar(20) DEFAULT NULL,
	NumeroComprobante varchar(20) NOT NULL,
	FechaComprobante datetime NOT NULL,
	Inpuesto decimal(4,2) NOT NULL,
	TotalCompra decimal(11,2) NOT NULL,
	Estado boolean NOT NULL DEFAULT 1,
	created_by int(11) NOT NULL,
	updated_by int(11) NOT NULL,
	created_at timestamp NOT NULL DEFAULT NOW(),
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE detalle_venta(
	IDDetalleIngreso int(11) NOT NULL,
	IDIngreso int(11) NOT NULL,
	IDArticulo int(11) NOT NULL,
	Cantidad int(4) NOT NULL,
	PrecioCompra decimal(11,2) NOT NULL,
	PrecioVenta decimal(11,2) NOT NULL,
	Estado boolean NOT NULL DEFAULT 1,
	created_by int(11) NOT NULL,
	updated_by int(11) NOT NULL,
	created_at timestamp NOT NULL DEFAULT NOW(),
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);




ALTER TABLE categoria
  ADD PRIMARY KEY (IDCategoria),
  ADD KEY created_by (created_by),
  ADD KEY updated_by (updated_by);
ALTER TABLE articulo
  ADD PRIMARY KEY (IDArticulo),
  ADD KEY IDCategoria (IDCategoria),
  ADD KEY created_by (created_by),
  ADD KEY updated_by (updated_by);
ALTER TABLE articulo
  ADD UNIQUE INDEX index_nombre_producto (Nombre);

ALTER TABLE cliente
  ADD PRIMARY KEY (IDCliente),
  ADD KEY created_by (created_by),
  ADD KEY updated_by (updated_by);
ALTER TABLE departamento
  ADD PRIMARY KEY (IDDepartamento),
  ADD KEY created_by (created_by),
  ADD KEY updated_by (updated_by);
ALTER TABLE puesto
  ADD PRIMARY KEY (IDPuesto),
  ADD KEY IDDepartamento (IDDepartamento),
  ADD KEY created_by (created_by),
  ADD KEY updated_by (updated_by);
ALTER TABLE usuario
  ADD PRIMARY KEY (IDUsuario),
  ADD KEY IDPuesto (IDPuesto),
  ADD KEY IDRole (IDRole),
  ADD KEY created_by (created_by),
  ADD KEY updated_by (updated_by);
ALTER TABLE role
  ADD PRIMARY KEY (IDRole),
  ADD KEY created_by (created_by),
  ADD KEY updated_by (updated_by);
ALTER TABLE permiso
  ADD PRIMARY KEY (IDPermiso),
  ADD KEY created_by (created_by),
  ADD KEY updated_by (updated_by);
ALTER TABLE role_permiso
  ADD PRIMARY KEY (IDRolePermiso),
  ADD KEY IDRole (IDRole),
  ADD KEY IDPermiso (IDPermiso),
  ADD KEY created_by (created_by),
  ADD KEY updated_by (updated_by);
ALTER TABLE ingreso
  ADD PRIMARY KEY (IDIngreso),
  ADD KEY IDProveedor (IDProveedor),
  ADD KEY created_by (created_by),
  ADD KEY updated_by (updated_by);
ALTER TABLE detalle_ingreso
  ADD PRIMARY KEY (IDDetalleIngreso),
  ADD KEY IDIngreso (IDIngreso),
  ADD KEY IDArticulo (IDArticulo),
  ADD KEY created_by (created_by),
  ADD KEY updated_by (updated_by);
ALTER TABLE proveedor
  ADD PRIMARY KEY (IDProveedor),
  ADD KEY created_by (created_by),
  ADD KEY updated_by (updated_by);


ALTER TABLE categoria
  MODIFY IDCategoria int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE articulo
  MODIFY IDArticulo int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE cliente
  MODIFY IDCliente int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE departamento
  MODIFY IDDepartamento int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE puesto
  MODIFY IDPuesto int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE usuario
  MODIFY IDUsuario int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE role
  MODIFY IDRole int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE permiso
  MODIFY IDPermiso int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE role_permiso
  MODIFY IDRolePermiso int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE ingreso
  MODIFY IDIngreso int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE detalle_ingreso
  MODIFY IDDetalleIngreso int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE proveedor
  MODIFY IDProveedor int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE categoria
	ADD FOREIGN KEY (created_by) REFERENCES usuario(IDUsuario) ON DELETE RESTRICT ON UPDATE RESTRICT,
	ADD FOREIGN KEY (updated_by) REFERENCES usuario(IDUsuario) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE articulo
	ADD FOREIGN KEY (IDCategoria) REFERENCES categoria(IDCategoria) ON DELETE RESTRICT ON UPDATE RESTRICT,
	ADD FOREIGN KEY (created_by) REFERENCES usuario(IDUsuario) ON DELETE RESTRICT ON UPDATE RESTRICT,
	ADD FOREIGN KEY (updated_by) REFERENCES usuario(IDUsuario) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE cliente
	ADD FOREIGN KEY (created_by) REFERENCES usuario(IDUsuario) ON DELETE RESTRICT ON UPDATE RESTRICT,
	ADD FOREIGN KEY (updated_by) REFERENCES usuario(IDUsuario) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE departamento
	ADD FOREIGN KEY (created_by) REFERENCES usuario(IDUsuario) ON DELETE RESTRICT ON UPDATE RESTRICT,
	ADD FOREIGN KEY (updated_by) REFERENCES usuario(IDUsuario) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE puesto
	ADD FOREIGN KEY (IDDepartamento) REFERENCES departamento(IDDepartamento) ON DELETE RESTRICT ON UPDATE RESTRICT,
	ADD FOREIGN KEY (created_by) REFERENCES usuario(IDUsuario) ON DELETE RESTRICT ON UPDATE RESTRICT,
	ADD FOREIGN KEY (updated_by) REFERENCES usuario(IDUsuario) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE usuario
	ADD FOREIGN KEY (IDPuesto) REFERENCES puesto(IDPuesto) ON DELETE RESTRICT ON UPDATE RESTRICT,
	ADD FOREIGN KEY (created_by) REFERENCES usuario(IDUsuario) ON DELETE RESTRICT ON UPDATE RESTRICT,
	ADD FOREIGN KEY (updated_by) REFERENCES usuario(IDUsuario) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE role
	ADD FOREIGN KEY (created_by) REFERENCES usuario(IDUsuario) ON DELETE RESTRICT ON UPDATE RESTRICT,
	ADD FOREIGN KEY (updated_by) REFERENCES usuario(IDUsuario) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE permiso
	ADD FOREIGN KEY (created_by) REFERENCES usuario(IDUsuario) ON DELETE RESTRICT ON UPDATE RESTRICT,
	ADD FOREIGN KEY (updated_by) REFERENCES usuario(IDUsuario) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE role_permiso
	ADD FOREIGN KEY (IDRole) REFERENCES role(IDRole) ON DELETE RESTRICT ON UPDATE RESTRICT,
	ADD FOREIGN KEY (IDPermiso) REFERENCES permiso(IDPermiso) ON DELETE RESTRICT ON UPDATE RESTRICT,
	ADD FOREIGN KEY (created_by) REFERENCES usuario(IDUsuario) ON DELETE RESTRICT ON UPDATE RESTRICT,
	ADD FOREIGN KEY (updated_by) REFERENCES usuario(IDUsuario) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE proveedor
	ADD FOREIGN KEY (created_by) REFERENCES usuario(IDUsuario) ON DELETE RESTRICT ON UPDATE RESTRICT,
	ADD FOREIGN KEY (updated_by) REFERENCES usuario(IDUsuario) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE ingreso
	ADD FOREIGN KEY (IDProveedor) REFERENCES proveedor(IDProveedor) ON DELETE RESTRICT ON UPDATE RESTRICT,
	ADD FOREIGN KEY (created_by) REFERENCES usuario(IDUsuario) ON DELETE RESTRICT ON UPDATE RESTRICT,
	ADD FOREIGN KEY (updated_by) REFERENCES usuario(IDUsuario) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE detalle_ingreso
	ADD FOREIGN KEY (IDIngreso) REFERENCES ingreso(IDIngreso) ON DELETE RESTRICT ON UPDATE RESTRICT,
	ADD FOREIGN KEY (IDArticulo) REFERENCES articulo(IDArticulo) ON DELETE RESTRICT ON UPDATE RESTRICT,
	ADD FOREIGN KEY (created_by) REFERENCES usuario(IDUsuario) ON DELETE RESTRICT ON UPDATE RESTRICT,
	ADD FOREIGN KEY (updated_by) REFERENCES usuario(IDUsuario) ON DELETE RESTRICT ON UPDATE RESTRICT;


  INSERT INTO articulo(IDCategoria,Codigo,Nombre,Stock,Estado,created_by,updated_by)
  VALUES (1,1,'Manzana',5,1,1,1);

