<?php  
	
	/*
		Include the require for class conexion
	*/
	require "../config/Conexion.php";
	/**
	* Class for Cliente
	*/
	class Cliente
	{
		
		/*
			Constructor for class
		*/
		public function __construct()
		{
			# code...
		}

		public function create($nombre,$nombrecomercial,$tipo_documento,$numero_documento,$telefono,$fax,$correo,$direccion,$id_user){
			$sql = "INSERT INTO cliente (Nombre,NombreComercial,TipoDocumento,NumeroDocumento,Telefono,Fax,Correo,Direccion,created_by,updated_by) VALUES('$nombre','$nombrecomercial','$tipo_documento','$numero_documento','$telefono','Fax','$correo','$direccion','$id_user','$id_user')";
			return ejecutarConsulta($sql);
		}

		public function edit($id_cliente,$nombre,$nombrecomercial,$tipo_documento,$numero_documento,$direccion,$telefono,$fax,$correo,$id_user){
			$sql = "UPDATE cliente SET Nombre='$nombre',NombreComercial='$nombrecomercial',TipoDocumento='$tipo_documento',NumeroDocumento='$numero_documento',Telefono='$telefono',Correo='$correo',Direccion='$direccion',updated_by='$id_user' WHERE IDCliente='$id_cliente'";
			return ejecutarConsulta($sql);
		}

		public function disable($id_cliente/*,$id_user*/){
			$sql = "UPDATE cliente SET Estado='0' WHERE IDCliente='$id_cliente'";
			return ejecutarConsulta($sql);
		}

		public function enable($id_cliente/*,$id_user*/){
			$sql = "UPDATE cliente SET Estado='1' WHERE IDCliente='$id_cliente'";
			return ejecutarConsulta($sql);
		}

		public function mostrar($id_cliente){
			$sql = "SELECT * FROM cliente WHERE IDCliente='$id_cliente'";
			return ejecutarConsultaPorFila($sql);
		}

		public function showAll(){
			/*$sql = "SELECT c.IDCliente,c.Nombre,c.TipoDocumento,c.NumeroDocumento,c.Telefono,
			c.Correo,c.Direccion,c.updated_by,c.created_at,c.updated_at,u.IDUsuario,u.NombreUsuario 
			FROM cliente c INNER JOIN usuario u ON c.updated_by=u.IDUsuario";
			*/
			$sql = "SELECT IDCliente,Nombre,TipoDocumento,NumeroDocumento,Telefono,
			Correo,Direccion,Estado,updated_at FROM cliente";
			return ejecutarConsulta($sql);
		}

		public function detalle($id_cliente){
			$sql = "SELECT c.IDCliente,c.Nombre,c.NombreComercial,c.TipoDocumento,c.NumeroDocumento,c.Telefono,c.Fax,
			c.Correo,c.Direccion,c.Estado,c.updated_by,c.created_at,c.updated_at,u.CodUsuario,u.NombreUsuario 
			FROM cliente c INNER JOIN usuario u ON c.updated_by=u.CodUsuario
			WHERE c.IDCliente='$id_cliente'";
			return ejecutarConsultaPorFila($sql);
		}

		public function search_cod($id_cliente){
			$sql = "SELECT IDCliente FROM cliente WHERE IDCliente='$id_cliente'";
			return ejecutarConsultaPorFila($sql);
		}
	}
?>