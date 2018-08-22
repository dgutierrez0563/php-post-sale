
<?php  
	
	/*
		Include the require for class conexion
	*/
	require "../config/Conexion.php";
	/**
	* Class for Puesto
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

		public function create($nombre,$detalle,$id_user){
			$sql = "INSERT INTO permiso (Nombre,Detalle,created_by,updated_by) VALUES('$nombre','$detalle','$id_user','$id_user')";
			return ejecutarConsulta($sql);
		}

		public function edit($id_permiso,$nombre,$detalle,$id_user){
			$sql = "UPDATE permiso SET Nombre='$nombre',Detalle='$detalle',updated_by='$id_user' WHERE IDPermiso='$id_permiso'";
			return ejecutarConsulta($sql);
		}

		public function disable($id_permiso/*,$id_user*/){
			$sql = "UPDATE permiso SET Estado='0' WHERE IDPermiso='$id_permiso'";
			return ejecutarConsulta($sql);
		}

		public function enable($id_permiso/*,$id_user*/){
			$sql = "UPDATE permiso SET Estado='1' WHERE IDPermiso='$id_permiso'";
			return ejecutarConsulta($sql);
		}

		public function mostrar($id_permiso){
			$sql = "SELECT * FROM permiso WHERE IDPermiso='$id_permiso'";
			return ejecutarConsultaPorFila($sql);
		}

		public function showAll(){
			$sql = "SELECT p.IDPermiso,p.Nombre,p.Detalle,p.Estado,p.updated_by,p.updated_at,u.IDUsuario,u.NombreUsuario FROM permiso p INNER JOIN usuario u ON p.updated_by=u.IDUsuario";
			return ejecutarConsulta($sql);
		}

		public function listarPuestos(){
			$sql = "SELECT IDPermiso,Nombre FROM permiso ORDER BY Nombre";
			return ejecutarConsulta($sql);
		}
	}
?>