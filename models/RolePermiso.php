
<?php  
	
	/*
		Include the require for class conexion
	*/
	require "../config/Conexion.php";
	/**
	* Class for RoleAcceso
	*/
	class RolePermiso
	{
		
		/*
			Constructor for class
		*/
		public function __construct(){ }

		public function create($id_role,$id_permiso,$id_user){
			$sql = "INSERT INTO rolepermiso(IDRole,IDPermiso,create_by,updated_by) VALUES('$id_role','$id_permiso','$id_user','$id_user')";
			return ejecutarConsulta($sql);
		}

		public function delete($id_acceso){
			$sql = "DELETE FROM rolepermiso WHERE IDRolePermiso='$id_acceso'";
			return ejecutarConsulta($sql);
		}

		public function view($id_role){
			$sql = "SELECT a.IDRolePermiso AS IDRolePermiso,a.IDRole,a.IDPermiso,a.updated_at AS updated_at,r.IDRole,
			r.Nombre AS NombreRole,r.Estado,p.IDPermiso,p.Nombre AS NombrePermiso,p.Estado 
			FROM rolepermiso a INNER JOIN role r ON a.IDRole=r.IDRole
			INNER JOIN permiso p ON a.IDPermiso=p.IDPermiso
			WHERE r.Estado='1' AND p.Estado='1' AND r.IDRole='$id_role'";
			return ejecutarConsulta($sql);
		}
	}

?>