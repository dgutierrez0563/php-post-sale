<?php  
	
	/*
		Include the require for class conexion
	*/
	require "../config/Conexion.php";
	/**
	* Class for Proveedor
	*/
	class Proveedor
	{
		
		/*
			Constructor for class
		*/
		public function __construct()
		{
			# code...
		}

		public function create($nombre,$tipo_documento,$numero_documento,$direccion,$telefono,$correo,$id_user){
			$sql = "INSERT INTO proveedor (Nombre,TipoDocumento,NumeroDocumento,Direccion,Telefono,Correo,created_by,updated_by) VALUES('$nombre','$tipo_documento','$numero_documento','$direccion','$telefono','$correo','$id_user','$id_user')";
			return ejecutarConsulta($sql);
		}

		public function edit($id_proveedor,$nombre,$tipo_documento,$numero_documento,$direccion,$telefono,$correo,$id_user){
			$sql = "UPDATE proveedor SET Nombre='$nombre',TipoDocumento='$tipo_documento',NumeroDocumento='$numero_documento',Direccion='$direccion',Telefono='$telefono',Correo='$correo',updated_by='$id_user' WHERE IDProveedor='$id_proveedor'";
			return ejecutarConsulta($sql);
		}

		public function disable($id_proveedor/*,$id_user*/){
			$sql = "UPDATE proveedor SET Estado='0' WHERE IDProveedor='$id_proveedor'";
			return ejecutarConsulta($sql);
		}

		public function enable($id_proveedor/*,$id_user*/){
			$sql = "UPDATE proveedor SET Estado='1' WHERE IDProveedor='$id_proveedor'";
			return ejecutarConsulta($sql);
		}

		public function mostrar($id_proveedor){
			$sql = "SELECT * FROM proveedor WHERE IDProveedor='$id_proveedor'";
			return ejecutarConsultaPorFila($sql);
		}

		public function showAll(){
			//$sql = "SELECT p.IDProveedor,p.Nombre,p.TipoDocumento,p.NumeroDocumento,p.Direccion,p.Telefono,p.Correo,p.Estado,p.updated_by,p.updated_at,
			//u.IDUsuario,u.NombreUsuario FROM proveedor p INNER JOIN usuario u ON p.updated_by=u.IDUsuario";
			$sql = "SELECT IDProveedor,Nombre,TipoDocumento,NumeroDocumento,Direccion,Telefono,Correo,Estado,updated_at FROM proveedor";
			return ejecutarConsulta($sql);
		}

		public function detailItem($id_proveedor){
			$sql = "SELECT p.IDProveedor,p.Nombre,p.TipoDocumento,p.NumeroDocumento,p.Direccion,p.Telefono,
			p.Correo,p.Estado,p.updated_by,p.updated_at,u.IDUsuario,u.NombreUsuario 
			FROM proveedor p INNER JOIN usuario u ON p.updated_by=u.IDUsuario";
			return ejecutarConsulta($sql);
		}
	}
?>