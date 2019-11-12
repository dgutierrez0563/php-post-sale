
<?php  
	
	/*
		Include the require for class conexion
	*/
	require "../config/Conexion.php";
	/**
	* Class for Permiso
	*/
	class Permiso
	{
		
		/*
			Constructor for class
		*/
		public function __construct()
		{
			# code...
		}

		public function create($codpermiso,$nombre,$detalle,$id_user){
			$sql = "INSERT INTO permiso (CodPermiso,NombrePermiso,Detalle,created_by,updated_by) 
				VALUES('$codpermiso','$nombre','$detalle','$id_user','$id_user')";
			return ejecutarConsulta($sql);
		}

		public function edit($codpermiso,$nombre,$detalle,$id_user,$codpermiso_id){
			$sql = "UPDATE permiso SET CodPermiso='$codpermiso',NombrePermiso='$nombre',Detalle='$detalle',updated_by='$id_user' 
				WHERE CodPermiso='$codpermiso_id'";
			return ejecutarConsulta($sql);
		}

		public function disable($codpermiso/*,$id_user*/){
			$sql = "UPDATE permiso SET Estado='0' WHERE CodPermiso='$codpermiso'";
			return ejecutarConsulta($sql);
		}

		public function enable($codpermiso/*,$id_user*/){
			$sql = "UPDATE permiso SET Estado='1' WHERE CodPermiso='$codpermiso'";
			return ejecutarConsulta($sql);
		}

		public function mostrar($codpermiso){
			$sql = "SELECT CodPermiso,NombrePermiso,Detalle FROM permiso WHERE CodPermiso='$codpermiso'";
			return ejecutarConsultaPorFila($sql);
		}

		public function showAll(){
			$sql = "SELECT p.CodPermiso,p.NombrePermiso,p.Detalle,p.Estado,p.updated_at,u.NombreUsuario 
				FROM permiso p INNER JOIN usuario u ON p.updated_by=u.CodUsuario
				ORDER BY p.NombrePermiso DESC";
			return ejecutarConsulta($sql);
		}

		public function listarPermisos(){
			$sql = "SELECT CodPermiso,NombrePermiso FROM permiso WHERE Estado='1' ORDER BY NombrePermiso";
			return ejecutarConsulta($sql);
		}

		// public function listarPermisoJson(){
		// 	$sql = "SELECT Nombre,Estado FROM permiso WHERE Estado='1' ORDER BY Nombre";
		// 	return ejecutarConsulta($sql);
		// }

		public function search_cod($codpermiso){
			$sql = "SELECT CodPermiso FROM permiso WHERE CodPermiso='$codpermiso'";
			return ejecutarConsultaPorFila($sql);
		}

		public function topCodPermiso(){
			$sql = "SELECT (CodPermiso+1) AS TopCod FROM permiso ORDER BY CodPermiso DESC LIMIT 0,1";
			return ejecutarConsulta($sql);
		}
	}
?>