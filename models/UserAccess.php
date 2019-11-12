
<?php  
	
	/*
		Include the require for class conexion
	*/
	require "../config/Conexion.php";
	/**
	* Class for Usuario
	*/
	class UserAccess
	{
		
		/*
			Constructor for class
		*/
		public function __construct() {	 }
		
		// public function verify($username,$passwd){
		// 	$sql = "SELECT CodUsuario,NombreCompleto,TipoDocumento,
		// 		NumeroDocumento,Correo,NombreUsuario
		// 		FROM usuario 
		// 		WHERE NombreUsuario='$username' AND Contrasenia='$passwd' AND Estado='1'";
		// 	return ejecutarConsulta($sql);
		// }
		public function verify($username,$passwd){
			$sql = "SELECT u.CodUsuario,u.NombreCompleto,u.TipoDocumento,
				u.NumeroDocumento,u.Correo,u.NombreUsuario,r.Nombre
				FROM usuario u INNER JOIN role r ON u.CodRole=r.CodRole
				WHERE u.NombreUsuario='$username' AND u.Contrasenia='$passwd' AND u.Estado='1'";
			return ejecutarConsulta($sql);
		}
		public function accesslist($coduser){
			$sql = "SELECT p.CodPermiso,p.NombrePermiso
				FROM permiso p INNER JOIN rolepermiso rp ON p.CodPermiso=rp.CodPermiso
				INNER JOIN role r ON r.CodRole=rp.CodRole
				INNER JOIN usuario u ON u.CodRole=r.CodRole
				WHERE p.Estado='1' AND rp.Estado='1' AND r.Estado='1' 
				AND u.Estado='1' AND u.CodUsuario='$coduser'";
			return ejecutarConsulta($sql);
		}
	}
?>