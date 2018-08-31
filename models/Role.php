
<?php  
	
	/*
		Include the require for class conexion
	*/
	require "../config/Conexion.php";
	/**
	* Class for Puesto
	*/
	class Role
	{
		
		/*
			Constructor for class
		*/
		public function __construct()
		{
			# code...
		}

		public function create($nombre,$id_user){
			$sql = "INSERT INTO role (Nombre,created_by,updated_by) VALUES('$nombre','$id_user','$id_user')";
			return ejecutarConsulta($sql);
		}

		public function edit($id_role,$nombre,$id_user){
			$sql = "UPDATE role SET Nombre='$nombre',updated_by='$id_user' WHERE IDRole='$id_role'";
			return ejecutarConsulta($sql);
		}

		public function disable($id_role/*,$id_user*/){
			$sql = "UPDATE role SET Estado='0' WHERE IDRole='$id_role'";
			return ejecutarConsulta($sql);
		}

		public function enable($id_role/*,$id_user*/){
			$sql = "UPDATE role SET Estado='1' WHERE IDRole='$id_role'";
			return ejecutarConsulta($sql);
		}

		public function mostrar($id_role){
			$sql = "SELECT * FROM role WHERE IDRole='$id_role'";
			return ejecutarConsultaPorFila($sql);
		}

		public function showAll(){
			$sql = "SELECT r.IDRole,r.Nombre,r.Estado,r.updated_by,r.updated_at,u.IDUsuario,u.NombreUsuario FROM role r INNER JOIN usuario u ON r.updated_by=u.IDUsuario";
			return ejecutarConsulta($sql);
		}

		public function listarRoles(){
			$sql = "SELECT IDRole,Nombre,Estado FROM role WHERE Estado='1' ORDER BY Nombre";
			return ejecutarConsulta($sql);
		}
	}
?>