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

		public function create($codproveedor,$nombre,$tipo_documento,$numero_documento,$direccion,$telefono,$correo,$id_user){
			$sql = "INSERT INTO proveedor (CodProveedor,Nombre,TipoDocumento,NumeroDocumento,Direccion,Telefono,Correo,created_by,updated_by) 
			VALUES('$codproveedor','$nombre','$tipo_documento','$numero_documento','$direccion','$telefono','$correo','$id_user','$id_user')";
			return ejecutarConsulta($sql);
		}

		public function edit($codproveedor,$nombre,$tipo_documento,$numero_documento,$direccion,$telefono,$correo,$id_user,$codproveedor_id){
			$sql = "UPDATE proveedor SET CodProveedor='$codproveedor',Nombre='$nombre',TipoDocumento='$tipo_documento',NumeroDocumento='$numero_documento',Direccion='$direccion',Telefono='$telefono',Correo='$correo',updated_by='$id_user' WHERE CodProveedor='$codproveedor_id'";
			return ejecutarConsulta($sql);
		}

		public function disable($codproveedor/*,$id_user*/){
			$sql = "UPDATE proveedor SET Estado='0' WHERE CodProveedor='$codproveedor'";
			return ejecutarConsulta($sql);
		}

		public function enable($codproveedor/*,$id_user*/){
			$sql = "UPDATE proveedor SET Estado='1' WHERE CodProveedor='$codproveedor'";
			return ejecutarConsulta($sql);
		}

		public function mostrar($codproveedor){
			$sql = "SELECT * FROM proveedor WHERE CodProveedor='$codproveedor'";
			return ejecutarConsultaPorFila($sql);
		}

		public function showAll(){
			//$sql = "SELECT p.IDProveedor,p.Nombre,p.TipoDocumento,p.NumeroDocumento,p.Direccion,p.Telefono,p.Correo,p.Estado,p.updated_by,p.updated_at,
			//u.IDUsuario,u.NombreUsuario FROM proveedor p INNER JOIN usuario u ON p.updated_by=u.IDUsuario";
			$sql = "SELECT CodProveedor,Nombre,TipoDocumento,NumeroDocumento,Direccion,Telefono,Correo,Estado,updated_at FROM proveedor ORDER BY Nombre";
			return ejecutarConsulta($sql);
		}

		public function detailItem($codproveedor){
			$sql = "SELECT p.CodProveedor,p.Nombre,p.TipoDocumento,p.NumeroDocumento,p.Direccion,p.Telefono,
			p.Correo,p.Estado,p.updated_by,p.updated_at,u.CodUsuario,u.NombreUsuario 
			FROM proveedor p INNER JOIN usuario u ON p.updated_by=u.CodUsuario";
			return ejecutarConsulta($sql);
		}

		public function detalle($codproveedor){
			$sql = "SELECT p.CodProveedor,p.Nombre,p.TipoDocumento,p.NumeroDocumento,p.Telefono,
			p.Correo,p.Direccion,p.Estado,p.updated_by,p.created_at,p.updated_at,u.CodUsuario,u.NombreUsuario 
			FROM proveedor p INNER JOIN usuario u ON p.updated_by=u.CodUsuario
			WHERE p.CodProveedor='$codproveedor'";
			return ejecutarConsultaPorFila($sql);
		}

		public function search_cod($codproveedor){
			$sql = "SELECT CodProveedor FROM proveedor WHERE CodProveedor='$codproveedor'";
			return ejecutarConsultaPorFila($sql);
		}

		public function listarProveedor(){
			$sql = "SELECT CodProveedor, Nombre FROM proveedor WHERE Estado='1' ORDER BY Nombre";
			return ejecutarConsulta($sql);
		}
	}
?>