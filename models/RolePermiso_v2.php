
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

		public function create($id_role_asignacion,$id_permiso,$id_user){
			$sql = "INSERT INTO RolePermiso (CodRole,CodPermiso,created_by,updated_by)
			VALUES ('$id_role_asignacion','$id_permiso','$id_user','$id_user')";
			return ejecutarConsulta($sql);
			// $num_items = 0;
			// $var_stop = true;

			// while ($num_items < count($permisos)) {
			// 	$aux=$permisos[$num_items];
			// 	$sql = "INSERT INTO RolePermiso (CodRole,CodPermiso,created_by,updated_by)
			// 	VALUES ('$id_role_asignacion','$aux','$id_user','$id_user')";

			// 	return ejecutarConsulta($sql) OR $var_stop = false;

			// 	$num_items = $num_items ++;
			// }

			// return $var_stop;

			// $sql = "INSERT INTO rolepermiso (IDRole,IDPermiso,created_by,updated_by) 
			// VALUES('$id_role_asignacion','$id_permiso','$id_user','$id_user')";
			// return ejecutarConsulta($sql);
		}

		public function delete($id_acceso){
			$sql = "DELETE FROM rolepermiso WHERE IDRolePermiso='$id_acceso'";
			return ejecutarConsulta($sql);
		}

		public function view($id_role){
			$sql = "SELECT a.IDRolePermiso AS IDRolePermiso,a.IDRole,a.IDPermiso,a.updated_by AS updated_by,
			a.updated_at AS updated_at,r.IDRole,r.Nombre AS NombreRole,r.Estado,p.IDPermiso,
			p.Nombre AS NombrePermiso,p.Estado,u.IDUsuario AS IDUsuario,u.NombreUsuario AS NombreUsuario
			FROM rolepermiso a INNER JOIN role r ON a.IDRole=r.IDRole
			INNER JOIN permiso p ON a.IDPermiso=p.IDPermiso
			INNER JOIN usuario u ON a.updated_by=u.IDUsuario
			WHERE r.Estado='1' AND p.Estado='1' AND r.IDRole='$id_role'";
			return ejecutarConsulta($sql);
		}

		public function existeRolePermisoID($id_role_asignacion,$id_permiso){
			$sql = "SELECT CodRolePermiso 
				FROM rolepermiso WHERE CodRole='$id_role_asignacion' 
				AND CodPermiso='$id_permiso'";
			return existeRolePermiso($sql);
		}

		public function viewRolePermiso($id_role){
			$sql = "SELECT r.Nombre, p.CodPermiso,p.NombrePermiso 
				FROM rolepermiso rp INNER JOIN role r ON rp.CodRole=r.CodRole
				INNER JOIN permiso p ON rp.CodPermiso = p.CodPermiso
				WHERE p.Estado='1' AND r.CodRole='$id_role'";

			return ejecutarConsulta($sql);
		}
	}

?>