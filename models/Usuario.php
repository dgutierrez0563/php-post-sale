
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

		public function create($nombre,$tipo_documento,$numero_documento,$direccion,$telefono,$correo,$id_puesto,$id_role,$nombre_usuario,$contrasenia,$id_user){
			$sql = "INSERT INTO usuario (Nombre,TipoDocumento,NumeroDocumento,Direccion,Telefono,Correo,IDPuesto,IDRole,NombreUsuario,Contrasenia,created_by,updated_by) VALUES('$nombre','$tipo_documento','$numero_documento','$direccion','$telefono','$correo','$id_puesto','$id_role','$nombre_usuario','$contrasenia','$id_user','$id_user')";
			return ejecutarConsulta($sql);
		}

		public function edit($id_usuario,$nombre,$tipo_documento,$numero_documento,$direccion,$telefono,$correo,$id_puesto,$id_role,$nombre_usuario,$contrasenia,$id_user){
			$sql = "UPDATE usuario SET Nombre='$nombre',TipoDocumento='$tipo_documento',NumeroDocumento='$numero_documento',Direccion='$direccion',Telefono='$telefono',Correo='$correo',IDPuesto='$id_puesto',IDRole='$id_role',NombreUsuario='$nombre_usuario',Contrasenia='$contrasenia',updated_by='$id_user' WHERE IDUsuario='$id_usuario'";
			return ejecutarConsulta($sql);
		}

		public function disable($id_usuario/*,$id_user*/){
			$sql = "UPDATE usuario SET Estado='0' WHERE IDUsuario='$id_usuario'";
			return ejecutarConsulta($sql);
		}

		public function enable($id_usuario/*,$id_user*/){
			$sql = "UPDATE usuario SET Estado='1' WHERE IDUsuario='$id_usuario'";
			return ejecutarConsulta($sql);
		}

		public function mostrar($id_usuario){
			$sql = "SELECT * FROM usuario WHERE IDUsuario='$id_usuario'";
			return ejecutarConsultaPorFila($sql);
		}

		public function showAll(){
			$sql = "SELECT u.IDUsuario,u.Nombre,u.TipoDocumento,u.NumeroDocumento,
			u.Direccion,u.Telefono,u.Correo,u.IDPuesto,u.IDRole,u.NombreUsuario,
			u.Estado,u.updated_at,p.Nombre AS NombrePuesto,r.Nombre AS NombreRole 
			FROM usuario u INNER JOIN puesto p ON u.IDPuesto=p.IDPuesto
			INNER JOIN role r ON u.IDRole=r.IDRole";
			return ejecutarConsulta($sql);
		}
	}
?>