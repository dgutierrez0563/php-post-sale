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

		public function create($coddepartamento,$nombre,$id_user){
			$sql = "INSERT INTO departamento (CodDepartamento,NombreDepartamento,created_by,updated_by) 
			VALUES('$coddepartamento','$nombre','$id_user','$id_user')";
			return ejecutarConsulta($sql);
		}

		public function edit($coddepartamento,$nombre,$id_user,$coddepartamento_id){
			$sql = "UPDATE departamento SET CodDepartamento='$coddepartamento', NombreDepartamento='$nombre',
			updated_by='$id_user' WHERE CodDepartamento='$coddepartamento_id'";
			return ejecutarConsulta($sql);
		}

		public function disable($coddepartamento/*,$id_user*/){
			$sql = "UPDATE departamento SET Estado='0' WHERE CodDepartamento='$coddepartamento'";
			return ejecutarConsulta($sql);
		}

		public function enable($coddepartamento/*,$id_user*/){
			$sql = "UPDATE departamento SET Estado='1' WHERE CodDepartamento='$coddepartamento'";
			return ejecutarConsulta($sql);
		}

		public function mostrar($coddepartamento){
			$sql = "SELECT CodDepartamento,NombreDepartamento FROM departamento WHERE CodDepartamento='$coddepartamento'";
			return ejecutarConsultaPorFila($sql);
		}

		public function showAll(){
			$sql = "SELECT * FROM departamento";
			return ejecutarConsulta($sql);
		}

		public function listarDepartamentos(){
			$sql = "SELECT CodDepartamento AS CodDepartamento, NombreDepartamento AS NombreDepartamento FROM departamento WHERE Estado='1'";
			return ejecutarConsulta($sql);
		}

		public function detalle($coddepartamento){
			$sql = "SELECT d.CodDepartamento,d.NombreDepartamento,d.Estado,d.updated_by,d.created_at,
			d.updated_at,u.CodUsuario,u.NombreUsuario 
			FROM departamento d INNER JOIN usuario u ON d.updated_by=u.CodUsuario
			WHERE d.CodDepartamento='$coddepartamento'";
			return ejecutarConsultaPorFila($sql);
		}

		public function search_cod($coddepartamento){
			$sql = "SELECT CodDepartamento FROM departamento WHERE CodDepartamento='$coddepartamento'";
			return ejecutarConsultaPorFila($sql);
		}
	}
?>