<?php  
	
	/*
		Include the require for class conexion
	*/
	require "../config/Conexion.php";
	/**
	* Class for Articulo
	*/
	class Departamento
	{
		
		/*
			Constructor for class
		*/
		public function __construct()
		{
			# code...
		}

		public function create($nombre,$id_user){
			$sql = "INSERT INTO departamento (Nombre,created_by,updated_by) VALUES('$nombre','$id_user','$id_user')";
			return ejecutarConsulta($sql);
		}

		public function edit($id_departamento,$nombre,$id_user){
			$sql = "UPDATE departamento SET Nombre='$nombre',updated_by='$id_user' WHERE IDDepartamento='$id_departamento'";
			return ejecutarConsulta($sql);
		}

		public function disable($id_departamento/*,$id_user*/){
			$sql = "UPDATE departamento SET Estado='0' WHERE IDDepartamento='$id_departamento'";
			return ejecutarConsulta($sql);
		}

		public function enable($id_departamento/*,$id_user*/){
			$sql = "UPDATE departamento SET Estado='1' WHERE IDDepartamento='$id_departamento'";
			return ejecutarConsulta($sql);
		}

		public function mostrar($id_departamento){
			$sql = "SELECT * FROM departamento WHERE IDDepartamento='$id_departamento'";
			return ejecutarConsultaPorFila($sql);
		}

		public function showAll(){
			$sql = "SELECT * FROM departamento";
			return ejecutarConsulta($sql);
		}
	}
?>