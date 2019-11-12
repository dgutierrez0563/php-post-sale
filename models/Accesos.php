
<?php  
	
	/*
		Include the require for class conexion
	*/
	require "../config/Conexion.php";
	/**
	* Class for Permiso
	*/
	class Accesos
	{
		
		/*
			Constructor for class
		*/
		public function __construct()
		{
			# code...
		}

		public function create($id_role_asignacion,$permisos){
			// $sql = "INSERT INTO RolePermiso (CodRole,CodPermiso,created_by,updated_by)
			// VALUES ('$id_role_asignacion','$id_permiso','$id_user','$id_user')";
			// return ejecutarConsulta($sql);

			$num_items = 0;
			$var_stop = true;

			while ($num_items < count($permisos)) {
				//$aux=$permisos[$num_items];
				$sql = "INSERT INTO RolePermiso (CodRole,CodPermiso)
				VALUES ('$id_role_asignacion','$permisos[$num_items]')";

				return ejecutarConsulta($sql) OR $var_stop = false;

				$num_items = $num_items + 1;
			}

			return $var_stop;

			// $sql = "INSERT INTO rolepermiso (IDRole,IDPermiso,created_by,updated_by) 
			// VALUES('$id_role_asignacion','$id_permiso','$id_user','$id_user')";
			// return ejecutarConsulta($sql);
		}

		public function showAll(){
			$sql = "SELECT p.CodPermiso,p.NombrePermiso,p.Detalle,p.Estado,p.updated_by,p.updated_at,u.CodUsuario,u.NombreUsuario 
				FROM permiso p INNER JOIN usuario u ON p.updated_by=u.CodUsuario
				ORDER BY p.NombrePermiso";
			return ejecutarConsulta($sql);
		}

		public function listarAccesos(){
			$sql = "SELECT a.CodRolePermiso,r.Nombre,p.NombrePermiso,a.Estado 
				FROM rolepermiso a INNER JOIN role r
				ON a.CodRole = r.CodRole
				INNER JOIN permiso p ON a.CodPermiso = p.CodPermiso
				ORDER BY r.Nombre,p.NombrePermiso";
			return ejecutarConsulta($sql);
		}

		public function listarRoles(){
			$sql = "SELECT CodRole,Nombre FROM role WHERE Estado='1' ORDER BY Nombre";
			return ejecutarConsulta($sql);
		}

		public function eliminar($id_role_asignacion){
			$sql = "DELETE FROM rolepermiso WHERE CodRolePermiso='$id_role_asignacion'";
			return ejecutarConsulta($sql);
		}

	}
?>