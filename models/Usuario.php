
<?php  
	
	/*
		Include the require for class conexion
	*/
	require "../config/Conexion.php";
	/**
	* Class for Usuario
	*/
	class Usuario
	{
		
		/*
			Constructor for class
		*/
		public function __construct()
		{
			# code...
		}

		public function create($codusuario,$nombre,$tipo_documento,$numero_documento,$direccion,
			$telefono,$correo,$id_puesto,$id_role,$nombre_usuario,$contrasenia,$id_user){
			$sql = "INSERT INTO usuario (CodUsuario,NombreCompleto,TipoDocumento,NumeroDocumento,Direccion,
				Telefono,Correo,CodPuesto,CodRole,NombreUsuario,Contrasenia,created_by,updated_by) 
				VALUES('$codusuario','$nombre','$tipo_documento','$numero_documento','$direccion','$telefono',
				'$correo','$id_puesto','$id_role','$nombre_usuario','$contrasenia','$id_user','$id_user')";
			return ejecutarConsulta($sql);
		}

		public function edit($codusuario,$nombre,$tipo_documento,$numero_documento,$direccion,
			$telefono,$correo,$id_puesto,$id_role,$nombre_usuario,$id_user,$codusuario_id){
			$sql = "UPDATE usuario SET CodUsuario='$codusuario',NombreCompleto='$nombre',TipoDocumento='$tipo_documento',
				NumeroDocumento='$numero_documento',Direccion='$direccion',Telefono='$telefono',
				Correo='$correo',CodPuesto='$id_puesto',CodRole='$id_role',NombreUsuario='$nombre_usuario',
				updated_by='$id_user' WHERE CodUsuario='$codusuario_id'"; ///*Contrasenia=$contrasenia,*/
			return ejecutarConsulta($sql);
		}

		public function disable($codusuario/*,$id_user*/){
			$sql = "UPDATE usuario SET Estado='0' WHERE CodUsuario='$codusuario'";
			return ejecutarConsulta($sql);
		}

		public function enable($codusuario/*,$id_user*/){
			$sql = "UPDATE usuario SET Estado='1' WHERE CodUsuario='$codusuario'";
			return ejecutarConsulta($sql);
		}

		public function mostrar($codusuario){
			$sql = "SELECT CodUsuario,NombreCompleto,TipoDocumento,NumeroDocumento,CodPuesto,
				CodRole,Telefono,Correo,Direccion,NombreUsuario FROM usuario WHERE CodUsuario='$codusuario'";
			return ejecutarConsultaPorFila($sql);
		}

		public function showAll(){
			$sql = "SELECT u.CodUsuario,u.NombreCompleto,u.TipoDocumento,u.NumeroDocumento,
			u.Direccion,u.Telefono,u.Correo,u.CodPuesto,u.CodRole,u.NombreUsuario,
			u.Estado,u.updated_at,p.NombrePuesto,r.Nombre AS NombreRole 
			FROM usuario u INNER JOIN puesto p ON u.CodPuesto=p.CodPuesto
			INNER JOIN role r ON u.CodRole=r.CodRole";
			return ejecutarConsulta($sql);
		}

		public function detalle($codusuario){
			$sql = "SELECT u.CodUsuario,u.NombreCompleto,u.TipoDocumento,u.NumeroDocumento,
			u.Direccion,u.Telefono,u.Correo,u.NombreUsuario,
			u.Estado,u.created_at,u.updated_at,p.NombrePuesto,r.Nombre AS NombreRole 
			FROM usuario u INNER JOIN puesto p ON u.CodPuesto=p.CodPuesto
			INNER JOIN role r ON u.CodRole=r.CodRole
			WHERE u.CodUsuario='$codusuario'";
			return ejecutarConsultaPorFila($sql);
		}

		public function search_cod($codusuario){
			$sql = "SELECT CodUsuario FROM usuario WHERE CodUsuario='$codusuario'";
			return ejecutarConsultaPorFila($sql);
		}

		public function verficar($username,$passwd){
			$sql = "SELECT CodUsuario,NombreCompleto,TipoDocumento,
				NumeroDocumento,Correo,NombreUsuario
				FROM usuario 
				WHERE NombreUsuario='$username' AND Contrasenia='$passwd' AND Estado='1'";
			return ejecutarConsulta($sql);
		}

		public function topCod(){
			$sql = "SELECT (CodUsuario+1) AS TopCod FROM usuario
					ORDER BY CodUsuario DESC LIMIT 1";
			//return ejecutarConsulta($sql);
			return ejecutarConsultaPorFila($sql);
		}
	}
?>